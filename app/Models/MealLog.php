<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class MealLog extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'food_id', 'date', 'meal_type', 'servings', 'calculated_calories', 'status'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function dailyLog()
    {
        return $this->belongsTo(DailyLog::class, 'user_id', 'user_id')->whereColumn('daily_logs.date', 'meal_logs.date');
    }
}
