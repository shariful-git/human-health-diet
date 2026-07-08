<?php

namespace Tests\Feature;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChecklistTest extends TestCase
{
    use RefreshDatabase;

    public function test_day_cannot_be_completed_without_required_goals(): void
    {
        $user = User::factory()->create();
        DailyLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->post(route('checklist.complete'));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }
}
