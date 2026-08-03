<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\MealLog;
use App\Models\PlanDay;
use App\Models\PlanDayFood;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $dailyLog = DailyLog::firstOrCreate(['user_id' => $user->id, 'date' => $today]);

        $loggedMeals = MealLog::where('user_id', $user->id)
            ->where('date', $today)
            ->with('food')
            ->get()
            ->groupBy('meal_type');

        $plannedMeals = collect();
        if ($user->active_plan_id) {
            $currentDay = PlanDay::where('plan_id', $user->active_plan_id)
                ->where('day_number', $user->current_plan_day_number)
                ->first();

            if ($currentDay) {
                $plannedMeals = PlanDayFood::where('plan_day_id', $currentDay->id)
                    ->with('food')
                    ->get()
                    ->groupBy('meal_type');
            }
        }

        $summary = ['calories' => 0, 'protein' => 0, 'carbs' => 0, 'fat' => 0];
        $completedMeals = MealLog::where('user_id', $user->id)->where('date', $today)->with('food')->get();
        foreach ($completedMeals as $log) {
            $summary['calories'] += $log->calculated_calories;
            $summary['protein'] += ($log->food->protein * $log->servings);
            $summary['carbs'] += ($log->food->carbohydrate * $log->servings);
            $summary['fat'] += ($log->food->fat * $log->servings);
        }

        return view('meals.index', compact('loggedMeals', 'plannedMeals', 'summary', 'user', 'dailyLog'));
    }

    public function logFromPlan($planFoodId)
    {
        $planFood = PlanDayFood::with('food')->findOrFail($planFoodId);
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $calculatedCalories = (int) ($planFood->food->calories * $planFood->servings);

        MealLog::create([
            'user_id' => $user->id,
            'food_id' => $planFood->food_id,
            'date' => $today,
            'meal_type' => $planFood->meal_type,
            'servings' => $planFood->servings,
            'calculated_calories' => $calculatedCalories,
            'status' => 'completed',
        ]);

        $totalCalories = MealLog::where('user_id', $user->id)->where('date', $today)->sum('calculated_calories');
        DailyLog::where('user_id', $user->id)->where('date', $today)->update(['total_calories_intake' => $totalCalories]);

        return redirect()->route('meals.index')->with('success', "Added {$planFood->food->name} to your daily intake!");
    }

    public function destroy($id)
    {
        $mealLog = MealLog::where('user_id', Auth::id())->findOrFail($id);
        $date = $mealLog->date;

        $mealLog->delete();

        $totalCalories = MealLog::where('user_id', Auth::id())->where('date', $date)->sum('calculated_calories');
        DailyLog::where('user_id', Auth::id())->where('date', $date)->update(['total_calories_intake' => $totalCalories]);

        return redirect()->route('meals.index')->with('success', 'Food item removed from today\'s consumption journal.');
    }
}
