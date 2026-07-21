<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Models\MealLog;
use App\Models\PlanDay;
use App\Services\RewardStreakService;
use Carbon\Carbon;

class ChecklistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $dailyLog = DailyLog::firstOrCreate(['user_id' => $user->id, 'date' => $today]);

        $breakfastDone = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'breakfast')->where('status', 'completed')->exists();
        $lunchDone     = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'lunch')->where('status', 'completed')->exists();
        $dinnerDone    = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'dinner')->where('status', 'completed')->exists();
        $snacksDone    = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'snacks')->where('status', 'completed')->exists();

        $waterGoal = 3000;
        if ($user->active_plan_id) {
            $currentDayPlan = PlanDay::where('plan_id', $user->active_plan_id)
                ->where('day_number', $user->current_plan_day_number)
                ->first();
            if ($currentDayPlan) {
                $waterGoal = $currentDayPlan->water_goal_ml;
            }
        }

        $rewardPoints = 0;
        if ($user->rewardPoints) {
            foreach ($user->rewardPoints as $rewardPoint) {
                $rewardPoints += $rewardPoint->points;
            }
        }

        $waterDone = $dailyLog->water_intake_ml >= $waterGoal;

        $exerciseDone = $dailyLog->total_calories_burn > 0;
        $sleepDone    = $dailyLog->sleep_hours >= 7;

        return view('checklist.index', compact(
            'dailyLog',
            'breakfastDone',
            'lunchDone',
            'dinnerDone',
            'snacksDone',
            'waterDone',
            'exerciseDone',
            'sleepDone',
            'user',
            'rewardPoints'
        ));
    }

    public function completeDay()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::where('user_id', $user->id)->where('date', $today)->firstOrFail();

        if ($dailyLog->is_completed) {
            return redirect()->back()->with('info', 'You have already finalized and completed this day!');
        }

        $waterGoal = 3000;
        if ($user->active_plan_id) {
            $currentDayPlan = PlanDay::where('plan_id', $user->active_plan_id)
                ->where('day_number', $user->current_plan_day_number)
                ->first();
            if ($currentDayPlan) {
                $waterGoal = $currentDayPlan->water_goal_ml;
            }
        }

        $breakfastDone = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'breakfast')->where('status', 'completed')->exists();
        $lunchDone     = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'lunch')->where('status', 'completed')->exists();
        $dinnerDone    = MealLog::where('user_id', $user->id)->where('date', $today)->where('meal_type', 'dinner')->where('status', 'completed')->exists();
        $waterDone     = $dailyLog->water_intake_ml >= $waterGoal;

        if (!$breakfastDone || !$lunchDone || !$dinnerDone || !$waterDone) {
            return redirect()->back()->with('error', 'You must complete your main daily meals and reach your water goal before finalizing the day.');
        }

        $dailyLog->update(['is_completed' => true]);

        RewardStreakService::awardPoints($user, 'complete_day');
        RewardStreakService::updateStreak($user);

        if ($user->active_plan_id) {
            $activePlan = $user->activePlan;

            if ($user->current_plan_day_number < $activePlan->duration_days) {
                $user->increment('current_plan_day_number');
            } else {
                RewardStreakService::awardPoints($user, 'complete_plan');
                $user->update([
                    'active_plan_id' => null,
                    'current_plan_day_number' => 1
                ]);
                return redirect()->route('plans.index')->with('success', '🎉 AMAZING! You have completed the entire multi-day diet blueprint! +500 Bonus Points Logged!');
            }
        }

        return redirect()->back()->with('success', '🎉 Day Finalized! +20 Points secured and your active plan has advanced to the next checkpoint!');
    }
}
