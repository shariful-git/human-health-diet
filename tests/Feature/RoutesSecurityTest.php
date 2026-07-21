<?php

namespace Tests\Feature;

use App\Models\DailyLog;
use App\Models\Exercise;
use App\Models\ExerciseLog;
use App\Models\Food;
use App\Models\MealLog;
use App\Models\Plan;
use App\Models\PlanDay;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_delete_other_user_exercise_log(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $dailyLog = DailyLog::create([
            'user_id' => $user1->id,
            'date' => now()->toDateString(),
        ]);

        $exercise = Exercise::create([
            'name' => 'Running',
            'calories_burn_per_minute' => 10,
        ]);

        $exerciseLog = ExerciseLog::create([
            'daily_log_id' => $dailyLog->id,
            'exercise_id' => $exercise->id,
            'duration_minutes' => 30,
            'calculated_calories_burn' => 300,
            'is_completed' => true,
        ]);

        $response = $this->actingAs($user2)->delete(route('fitness.exercise.destroy', $exerciseLog->id));
        $response->assertNotFound();

        $this->assertDatabaseHas('exercise_logs', ['id' => $exerciseLog->id]);
    }

    public function test_user_cannot_update_other_user_plan_day(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $plan = Plan::create([
            'user_id' => $user1->id,
            'name' => 'Custom Plan',
            'duration_days' => 7,
            'plan_type' => 'custom',
            'is_active' => true,
        ]);

        $planDay = PlanDay::create([
            'plan_id' => $plan->id,
            'day_number' => 1,
            'water_goal_ml' => 3000,
        ]);

        $response = $this->actingAs($user2)->put(route('plans.day.update', $planDay->id), [
            'water_goal_ml' => 4000,
        ]);
        $response->assertNotFound();
    }

    public function test_deleting_meal_log_recalculates_daily_intake(): void
    {
        $user = User::factory()->create();
        $today = now()->toDateString();

        $food = Food::create([
            'name' => 'Apple',
            'category' => 'fruits',
            'calories' => 100,
            'protein' => 0.5,
            'carbohydrate' => 25,
            'fat' => 0.3,
        ]);

        $meal = MealLog::create([
            'user_id' => $user->id,
            'food_id' => $food->id,
            'date' => $today,
            'meal_type' => 'breakfast',
            'servings' => 2,
            'calculated_calories' => 200,
            'status' => 'completed',
        ]);

        DailyLog::create([
            'user_id' => $user->id,
            'date' => $today,
            'total_calories_intake' => 200,
        ]);

        $response = $this->actingAs($user)->delete(route('meals.destroy', $meal->id));
        $response->assertRedirect(route('meals.index'));

        $this->assertDatabaseHas('daily_logs', [
            'user_id' => $user->id,
            'date' => $today,
            'total_calories_intake' => 0,
        ]);
    }
}
