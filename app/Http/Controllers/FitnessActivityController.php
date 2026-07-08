<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Models\Exercise;
use App\Models\ExerciseLog;
use Carbon\Carbon;

class FitnessActivityController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => Auth::id(), 'date' => $today]);
        
        $exerciseLogs = $dailyLog->exerciseLogs()->with('exercise')->get();
        $allExercises = Exercise::all();

        return view('fitness.index', compact('dailyLog', 'exerciseLogs', 'allExercises'));
    }

    // ওয়াটার প্লাস করার জন্য কুইক অ্যাকশন লজিক
    public function updateWater(Request $request)
    {
        $request->validate(['amount' => 'required|integer|in:250,500,-250']);
        
        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => Auth::id(), 'date' => $today]);

        // পানি পানের পরিমাণ আপডেট (০ এর নিচে যেন না যায়)
        $newIntake = max(0, $dailyLog->water_intake_ml + $request->amount);
        $dailyLog->update(['water_intake_ml' => $newIntake]);

        return redirect()->back()->with('success', 'Water intake updated!');
    }

    // এক্সারসাইজ লগ করার লজিক
    public function storeExercise(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => Auth::id(), 'date' => $today]);

        $exercise = Exercise::find($request->exercise_id);
        $burn = $exercise->calories_burn_per_minute * $request->duration_minutes;

        ExerciseLog::create([
            'daily_log_id' => $dailyLog->id,
            'exercise_id' => $exercise->id,
            'duration_minutes' => $request->duration_minutes,
            'calculated_calories_burn' => $burn,
            'is_completed' => true
        ]);

        return redirect()->route('fitness.index')->with('success', 'Exercise logged successfully!');
    }

    public function destroyExercise($id)
    {
        $log = ExerciseLog::findOrFail($id);
        $log->delete();

        return redirect()->route('fitness.index')->with('success', 'Exercise log removed!');
    }
}