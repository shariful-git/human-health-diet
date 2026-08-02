<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;

        if (! $profile) {
            return response()->json(['message' => 'Profile not created yet.'], 404);
        }

        return response()->json(['data' => $profile], 200);
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:10|max:100',
            'height' => 'required|numeric|min:100|max:250', // in cm
            'weight' => 'required|numeric|min:30|max:300',  // in kg
            'activity_level' => 'required|in:low,medium,high',
            'goal' => 'required|in:weight_loss,weight_gain,maintain,muscle_gain',
            'medical_conditions' => 'nullable|array',
        ]);

        $profile = Auth::user()->profile()->updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return response()->json([
            'message' => 'Profile updated successfully!',
            'data' => $profile,
        ], 200);
    }
}
