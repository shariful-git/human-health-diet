<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDayFood extends Model
{
    protected $table = 'plan_day_foods';
    protected $fillable = ['plan_day_id', 'food_id', 'meal_type', 'servings'];

    public function day()
    {
        return $this->belongsTo(PlanDay::class, 'plan_day_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}