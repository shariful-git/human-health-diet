<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalVisitTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_portal_visit_is_tracked_on_get_request(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'page_visit',
            'tags' => 'visit',
        ]);
    }

    public function test_authenticated_user_visit_records_user_id(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        \App\Models\Profile::create([
            'user_id' => $user->id,
            'gender' => 'male',
            'age' => 25,
            'height' => 175,
            'weight' => 70,
            'activity_level' => 'medium',
            'goal' => 'maintain',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'page_visit',
            'tags' => 'visit',
            'user_id' => $user->id,
        ]);
    }

    public function test_duplicate_visits_within_throttle_window_are_deduplicated(): void
    {
        $this->get('/');
        $this->get('/');
        $this->get('/');

        $visitCount = AuditLog::where('event', 'page_visit')->count();

        $this::assertEquals(1, $visitCount);
    }
}
