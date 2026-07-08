<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    protected $fillable = ['user_id', 'food_id', 'date', 'meal_type', 'servings', 'calculated_calories', 'status'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dailyLog()
    {
        return $this->belongsTo(DailyLog::class);
    }
}
