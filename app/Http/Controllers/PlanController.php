<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanDay;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $defaultPlans = Plan::where('plan_type', 'default')->where('is_active', true)->get();
        $myCustomPlans = Plan::where('user_id', Auth::id())->where('plan_type', 'custom')->with('days')->get();

        return view('plans.index', compact('defaultPlans', 'myCustomPlans'));
    }

    public function createCustom()
    {
        return view('plans.create-custom');
    }

    public function storeCustom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration_days' => 'required|integer|in:7,15,30,45,60',
            'description' => 'nullable|string',
        ]);

        $plan = Plan::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'duration_days' => $request->duration_days,
            'plan_type' => 'custom',
            'is_active' => true
        ]);

        for ($i = 1; $i <= $request->duration_days; $i++) {
            PlanDay::create([
                'plan_id' => $plan->id,
                'day_number' => $i,
                'breakfast_suggestion' => 'Standard Balanced Breakfast',
                'lunch_suggestion' => 'Rice, Protein (Chicken/Fish), Veggies',
                'dinner_suggestion' => 'Light Protein & Salad',
                'snacks_suggestion' => 'Nuts or Fruit',
                'exercise_suggestion' => '30 Mins Brisk Walk',
                'water_goal_ml' => 3000,
                'sleep_goal_hours' => 8
            ]);
        }

        return redirect()->route('plans.edit.days', $plan->id)->with('success', 'Plan created! Now configure daily meals.');
    }

    public function editDays($id)
    {
        $plan = Plan::where('user_id', Auth::id())->with('days')->findOrFail($id);
        return view('plans.edit-days', compact('plan'));
    }

    public function updateDayRow(Request $request, $dayId)
    {
        $day = PlanDay::findOrFail($dayId);

        $day->update($request->only([
            'breakfast_suggestion',
            'lunch_suggestion',
            'dinner_suggestion',
            'snacks_suggestion',
            'exercise_suggestion',
            'water_goal_ml',
            'sleep_goal_hours'
        ]));

        return redirect()->back()->with('success', "Day {$day->day_number} settings updated successfully!");
    }

    public function destroy($id)
    {
        $plan = Plan::where('user_id', Auth::id())->where('plan_type', 'custom')->findOrFail($id);
        
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Custom plan and its daily schedules deleted successfully.');
    }
}
