<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Auditable;

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
