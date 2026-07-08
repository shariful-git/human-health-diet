<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Models\Food;
use App\Models\MealLog;
use Carbon\Carbon;

class MealController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => Auth::id(), 'date' => $today]);
        
        $meals = $dailyLog->mealLogs()->with('food')->get()->groupBy('meal_type');
        $allFoods = Food::all();

        return view('meals.index', compact('meals', 'allFoods', 'dailyLog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snacks',
            'servings' => 'required|numeric|min:0.1',
        ]);

        $today = Carbon::today()->toDateString();
        $dailyLog = DailyLog::firstOrCreate(['user_id' => Auth::id(), 'date' => $today]);
        
        $food = Food::find($request->food_id);
        $calculatedCalories = (int) ($food->calories * $request->servings);

        MealLog::create([
            'daily_log_id' => $dailyLog->id,
            'food_id' => $food->id,
            'meal_type' => $request->meal_type,
            'servings' => $request->servings,
            'calculated_calories' => $calculatedCalories,
            'is_completed' => true
        ]);

        return redirect()->route('meals.index')->with('success', 'Food added successfully!');
    }

    public function destroy($id)
    {
        $mealLog = MealLog::findOrFail($id);
        $mealLog->delete();

        return redirect()->route('meals.index')->with('success', 'Food removed successfully!');
    }
}