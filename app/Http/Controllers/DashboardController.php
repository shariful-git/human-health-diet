<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Models\PlanDay;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your health profile first!');
        }

        $todayLog = DailyLog::firstOrCreate([
            'user_id' => $user->id,
            'date' => Carbon::today()->toDateString()
        ]);

        $currentDayPlan = null;
        if ($user->active_plan_id) {
            $currentDayPlan = PlanDay::where('plan_id', $user->active_plan_id)->where('day_number', $user->current_plan_day_number)->first();
        }

        $calorieTarget = $profile->daily_calorie_target ?? 2000;
        $caloriePercentage = min(($todayLog->total_calories_intake / $calorieTarget) * 100, 100);
        $waterGoal = $currentDayPlan ? $currentDayPlan->water_goal_ml : 3000;
        $waterPercentage = min(($todayLog->water_intake_ml / $waterGoal) * 100, 100);

        return view('dashboard', compact('profile', 'todayLog', 'calorieTarget', 'caloriePercentage', 'waterGoal', 'waterPercentage', 'currentDayPlan', 'user'));
    }
}
