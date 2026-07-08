<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'duration_days',
        'plan_type',
        'is_active',
    ];

    public function days()
    {
        return $this->hasMany(PlanDay::class)->orderBy('day_number', 'asc');
    }
}
