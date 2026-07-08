<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exercises = [
            ['name' => 'Brisk Walking', 'calories_burn_per_minute' => 5, 'difficulty' => 'easy', 'instruction' => 'Walk at a fast pace, around 5-6 km/h.'],
            ['name' => 'Running / Jogging', 'calories_burn_per_minute' => 11, 'difficulty' => 'medium', 'instruction' => 'Keep a steady pace and maintain proper breathing.'],
            ['name' => 'Push Ups', 'calories_burn_per_minute' => 8, 'difficulty' => 'medium', 'instruction' => 'Keep your core tight and lower your chest to the floor.'],
            ['name' => 'Cycling', 'calories_burn_per_minute' => 7, 'difficulty' => 'easy', 'instruction' => 'Moderate cycling on flat ground.'],
            ['name' => 'Heavy Weight Lifting', 'calories_burn_per_minute' => 6, 'difficulty' => 'hard', 'instruction' => 'Focus on compound movements like squats and deadlifts.'],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
