<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $adminUserIds = User::where('is_admin', 1)->pluck('id', 'id')->toArray();
        $globalFoods = Food::whereIn('user_id', $adminUserIds)->latest()->get();
        $myFoods = Food::where('user_id', $userId)->latest()->get();

        return view('foods.index', compact('globalFoods', 'myFoods'));
    }

    public function create()
    {
        return view('foods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'serving_size' => 'required|string|max:100',
            'protein' => 'nullable|numeric|min:0',
            'carbohydrate' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'sugar' => 'nullable|numeric|min:0',
            'sodium' => 'nullable|numeric|min:0',
            'vitamins' => 'nullable|string|max:255',
            'minerals' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['protein'] = $validated['protein'] ?? 0;
        $validated['carbohydrate'] = $validated['carbohydrate'] ?? 0;
        $validated['fat'] = $validated['fat'] ?? 0;
        $validated['fiber'] = $validated['fiber'] ?? 0;
        $validated['sugar'] = $validated['sugar'] ?? 0;
        $validated['sodium'] = $validated['sodium'] ?? 0;
        $validated['is_admin_approved'] = false;

        Food::create($validated);

        return redirect()->route('foods.index')->with('success', 'Food item added to your personal collection successfully!');
    }

    public function edit($id)
    {
        $food = Food::where('user_id', Auth::id())->findOrFail($id);

        return view('foods.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'serving_size' => 'required|string|max:100',
            'protein' => 'nullable|numeric|min:0',
            'carbohydrate' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'fiber' => 'nullable|numeric|min:0',
            'sugar' => 'nullable|numeric|min:0',
            'sodium' => 'nullable|numeric|min:0',
            'vitamins' => 'nullable|string|max:255',
            'minerals' => 'nullable|string|max:255',
        ]);

        $validated['protein'] = $validated['protein'] ?? 0;
        $validated['carbohydrate'] = $validated['carbohydrate'] ?? 0;
        $validated['fat'] = $validated['fat'] ?? 0;
        $validated['fiber'] = $validated['fiber'] ?? 0;
        $validated['sugar'] = $validated['sugar'] ?? 0;
        $validated['sodium'] = $validated['sodium'] ?? 0;

        $food->update($validated);

        return redirect()->route('foods.index')->with('success', 'Personal food item updated successfully!');
    }

    public function destroy($id)
    {
        $food = Food::where('user_id', Auth::id())->findOrFail($id);
        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Food item removed from your personal collection.');
    }
}
