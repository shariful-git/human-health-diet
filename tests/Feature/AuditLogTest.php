<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_audit_log_on_model_creation(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret123',
        ]);

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'created',
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);

        $auditLog = AuditLog::where('auditable_type', User::class)->where('auditable_id', $user->id)->first();
        $this->assertNotNull($auditLog);
        $this->assertEquals('John Doe', $auditLog->new_values['name']);
        // Verify password is sanitized and excluded
        $this->assertArrayNotHasKey('password', $auditLog->new_values);
    }

    public function test_it_creates_audit_log_on_model_update(): void
    {
        $user = User::factory()->create(['name' => 'Original Name']);

        $user->update(['name' => 'Updated Name']);

        $auditLog = AuditLog::where('auditable_type', User::class)
            ->where('auditable_id', $user->id)
            ->where('event', 'updated')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertEquals('Original Name', $auditLog->old_values['name']);
        $this->assertEquals('Updated Name', $auditLog->new_values['name']);
    }

    public function test_it_creates_audit_log_on_model_deletion(): void
    {
        $food = Food::create([
            'name' => 'Apple',
            'category' => 'Fruit',
            'calories' => 95,
            'protein' => 0.5,
            'carbohydrate' => 25.0,
            'fat' => 0.3,
        ]);

        $foodId = $food->id;
        $food->delete();

        $auditLog = AuditLog::where('auditable_type', Food::class)
            ->where('auditable_id', $foodId)
            ->where('event', 'deleted')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertEquals('Apple', $auditLog->old_values['name']);
    }

    public function test_it_audits_login_event(): void
    {
        $user = User::factory()->create();

        event(new Login('web', $user, false));

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'login',
            'tags' => 'auth',
            'user_id' => $user->id,
        ]);
    }

    public function test_it_audits_logout_event(): void
    {
        $user = User::factory()->create();

        event(new Logout('web', $user));

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'logout',
            'tags' => 'auth',
            'user_id' => $user->id,
        ]);
    }

    public function test_it_audits_failed_login_event(): void
    {
        event(new Failed('web', null, ['email' => 'hacker@example.com']));

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'failed_login',
            'tags' => 'auth',
        ]);

        $auditLog = AuditLog::where('event', 'failed_login')->first();
        $this->assertEquals('hacker@example.com', $auditLog->new_values['attempted_email']);
    }

    public function test_prune_command_deletes_old_logs(): void
    {
        $oldLog = AuditLog::create([
            'event' => 'created',
            'auditable_type' => User::class,
            'auditable_id' => 1,
        ]);
        $oldLog->timestamps = false;
        $oldLog->created_at = now()->subDays(100);
        $oldLog->save();

        $recentLog = AuditLog::create([
            'event' => 'created',
            'auditable_type' => User::class,
            'auditable_id' => 2,
        ]);

        $this->artisan('audit:prune', ['--days' => 90])
            ->assertExitCode(0);

        $this->assertDatabaseMissing('audit_logs', ['id' => $oldLog->id]);
        $this->assertDatabaseHas('audit_logs', ['id' => $recentLog->id]);
    }
}
