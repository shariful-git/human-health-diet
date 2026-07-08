<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your health profile first!');
        }

        $plans = Plan::where('plan_type', 'default')->where('is_active', true)->get();
        return view('plans.index', compact('plans'));
    }

    public function enroll($id)
    {
        $plan = Plan::findOrFail($id);
        $user = Auth::user();

        $user->update(['active_plan_id' => $plan->id]);

        return redirect()->route('dashboard')->with('success', "Active Plan Set to: {$plan->name}!");
    }
}
