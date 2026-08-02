<?php

namespace App\Services;

class HealthCalculator
{
    public static function calculateBmi(float $weight, float $heightCm): float
    {
        if ($heightCm <= 0 || $weight <= 0) {
            return 0.0;
        }

        $heightMeters = $heightCm / 100;

        return round($weight / ($heightMeters * $heightMeters), 2);
    }

    public static function calculateBmr(string $gender, float $weight, float $heightCm, int $age): int
    {
        if ($gender === 'male') {
            return (int) ((10 * $weight) + (6.25 * $heightCm) - (5 * $age) + 5);
        }

        // Female & Other default to female equation for safety
        return (int) ((10 * $weight) + (6.25 * $heightCm) - (5 * $age) - 161);
    }

    public static function calculateTdee(int $bmr, string $activityLevel): int
    {
        $multipliers = [
            'low' => 1.2,       // Sedentary
            'medium' => 1.375,  // Lightly/Moderately active
            'high' => 1.55,     // Very active
        ];

        $multiplier = $multipliers[$activityLevel] ?? 1.2;

        return (int) ($bmr * $multiplier);
    }

    public static function determineCalorieTarget(int $tdee, string $goal): int
    {
        return match ($goal) {
            'weight_loss' => $tdee - 500,
            'weight_gain' => $tdee + 500,
            'muscle_gain' => $tdee + 300,
            'maintain' => $tdee,
            default => $tdee,
        };
    }
}
