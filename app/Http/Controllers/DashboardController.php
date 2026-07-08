<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Models\PlanDay;
use App\Models\MealLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.health.edit')->with('info', 'Please complete your health profile first!');
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
            $summary['protein']  += ($log->food->protein * $log->servings);
            $summary['carbs']    += ($log->food->carbohydrate * $log->servings);
            $summary['fat']      += ($log->food->fat * $log->servings);
        }

        $calorieTarget = $profile->daily_calorie_target ?? 2000;
        $caloriePercentage = min(($summary['calories'] / $calorieTarget) * 100, 100);

        $waterGoal = $currentDayPlan ? $currentDayPlan->water_goal_ml : 3000;
        $waterPercentage = min(($todayLog->water_intake_ml / $waterGoal) * 100, 100);

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
