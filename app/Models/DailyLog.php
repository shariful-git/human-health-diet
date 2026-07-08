<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $fillable = ['user_id', 'date', 'total_calories_intake', 'total_calories_burn', 'water_intake_ml', 'sleep_hours', 'weight_kg', 'steps', 'mood', 'is_completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mealLogs()
    {
        return $this->hasMany(MealLog::class);
    }

    public function exerciseLogs()
    {
        return $this->hasMany(ExerciseLog::class);
    }
}
