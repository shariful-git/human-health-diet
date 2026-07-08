<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    protected $fillable = ['daily_log_id', 'food_id', 'meal_type', 'servings', 'calculated_calories', 'is_completed'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dailyLog()
    {
        return $this->belongsTo(DailyLog::class);
    }

    protected static function booted()
    {
        static::saved(function ($mealLog) {
            $mealLog->dailyLog->update([
                'total_calories_intake' => $mealLog->dailyLog->mealLogs()->sum('calculated_calories')
            ]);
        });

        static::deleted(function ($mealLog) {
            $mealLog->dailyLog->update([
                'total_calories_intake' => $mealLog->dailyLog->mealLogs()->sum('calculated_calories')
            ]);
        });
    }
}
