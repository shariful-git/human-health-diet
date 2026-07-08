<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Services\RewardStreakService;
use Carbon\Carbon;

class ChecklistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your health profile first!');
        }

        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => $user->id, 'date' => $today]);

        $hasMeals = $dailyLog->mealLogs()->count() > 0;
        $hasWater = $dailyLog->water_intake_ml >= 2000;
        $hasExercise = $dailyLog->exerciseLogs()->count() > 0;

        $totalPoints = $user->rewardPoints()->sum('points');
        $streak = $user->streak;

        return view('checklist.index', compact('dailyLog', 'hasMeals', 'hasWater', 'hasExercise', 'totalPoints', 'streak'));
    }

    public function completeDay()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::where('user_id', $user->id)->where('date', $today)->firstOrFail();

        if ($dailyLog->is_completed) {
            return redirect()->back()->with('info', 'You have already completed your day!');
        }

        $dailyLog->update(['is_completed' => true]);

        RewardStreakService::awardPoints($user, 20, 'Completed Day Checklist');
        RewardStreakService::updateStreak($user);

        return redirect()->route('checklist.index')->with('success', '🎉 Awesome! Day Completed. +20 Points Awarded and Streak Updated!');
    }
}
