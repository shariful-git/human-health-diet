<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
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

        $todayLog = DailyLog::firstOrCreate(
            ['user_id' => $user->id, 'date' => Carbon::today()->toDateString()],
            [
                'total_calories_intake' => 0,
                'total_calories_burn' => 0,
                'water_intake_ml' => 0,
                'sleep_hours' => 0,
                'is_completed' => false
            ]
        );

        $calorieTarget = $profile->daily_calorie_target ?? 2000;
        $caloriePercentage = min(($todayLog->total_calories_intake / $calorieTarget) * 100, 100);

        $waterGoal = 3000;
        $waterPercentage = min(($todayLog->water_intake_ml / $waterGoal) * 100, 100);

        return view('dashboard', compact('profile', 'todayLog', 'calorieTarget', 'caloriePercentage', 'waterGoal', 'waterPercentage'));
    }
}
