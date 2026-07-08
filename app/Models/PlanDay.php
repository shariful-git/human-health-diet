<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDay extends Model
{
    protected $fillable = [
        'plan_id',
        'day_number',
        'breakfast_suggestion',
        'lunch_suggestion',
        'dinner_suggestion',
        'snacks_suggestion',
        'exercise_suggestion',
        'water_goal_ml',
        'sleep_goal_hours',
        'notes'
    ];

    public function planFoods()
    {
        return $this->hasMany(PlanDayFood::class, 'plan_day_id');
    }
}
