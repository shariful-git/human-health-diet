<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\MealLog;
use App\Models\PlanDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your health profile first!');
        }

        $today = Carbon::today()->toDateString();
        $todayLog = DailyLog::firstOrCreate(['user_id' => $user->id, 'date' => $today]);

        $currentDayPlan = null;
        $plannedMeals = collect();
        if ($user->active_plan_id) {
            $currentDayPlan = PlanDay::where('plan_id', $user->active_plan_id)
                ->where('day_number', $user->current_plan_day_number)
                ->first();

            if ($currentDayPlan) {
                $plannedMeals = $currentDayPlan->planFoods()->with('food')->get()->groupBy('meal_type');
            }
        }

        $summary = ['calories' => 0, 'protein' => 0, 'carbs' => 0, 'fat' => 0];
        $completedMeals = MealLog::where('user_id', $user->id)->where('date', $today)->where('status', 'completed')->with('food')->get();
        foreach ($completedMeals as $log) {
            $summary['calories'] += $log->calculated_calories;
            $summary['protein'] += ($log->food->protein * $log->servings);
            $summary['carbs'] += ($log->food->carbohydrate * $log->servings);
            $summary['fat'] += ($log->food->fat * $log->servings);
        }

        $calorieTarget = $profile->daily_calorie_target ?? 2000;
        $caloriePercentage = $calorieTarget > 0 ? min(($summary['calories'] / $calorieTarget) * 100, 100) : 0;

        $waterGoal = $currentDayPlan ? $currentDayPlan->water_goal_ml : 3000;
        $waterPercentage = $waterGoal > 0 ? min(($todayLog->water_intake_ml / $waterGoal) * 100, 100) : 0;

        return view('dashboard', compact(
            'profile',
            'todayLog',
            'calorieTarget',
            'caloriePercentage',
            'waterGoal',
            'waterPercentage',
            'currentDayPlan',
            'plannedMeals',
            'summary',
            'user'
        ));
    }
}
