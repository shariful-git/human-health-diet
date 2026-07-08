<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            ['name' => 'White Rice', 'category' => 'Lunch', 'calories' => 130, 'protein' => 2.7, 'carbohydrate' => 28, 'fat' => 0.3, 'serving_size' => '100g'],
            ['name' => 'Chicken Breast (Cooked)', 'category' => 'Lunch', 'calories' => 165, 'protein' => 31, 'carbohydrate' => 0, 'fat' => 3.6, 'serving_size' => '100g'],
            ['name' => 'Boiled Egg', 'category' => 'Breakfast', 'calories' => 78, 'protein' => 6, 'carbohydrate' => 0.6, 'fat' => 5, 'serving_size' => '1 Pcs'],
            ['name' => 'Apple', 'category' => 'Snacks', 'calories' => 52, 'protein' => 0.3, 'carbohydrate' => 14, 'fat' => 0.2, 'serving_size' => '100g'],
            ['name' => 'Whole Milk', 'category' => 'Breakfast', 'calories' => 149, 'protein' => 8, 'carbohydrate' => 12, 'fat' => 8, 'serving_size' => '1 Glass (240ml)'],
            ['name' => 'Oats', 'category' => 'Breakfast', 'calories' => 389, 'protein' => 16.9, 'carbohydrate' => 66, 'fat' => 6.9, 'serving_size' => '100g'],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
