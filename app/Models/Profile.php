<?php

namespace App\Models;

use App\Services\HealthCalculator;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Auditable;

    protected $fillable = ['user_id', 'gender', 'age', 'height', 'weight', 'activity_level', 'goal', 'daily_calorie_target', 'bmi', 'bmr', 'tdee', 'medical_conditions'];

    protected $casts = [
        'medical_conditions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Laravel Model Hook to auto calculate before saving
    protected static function booted()
    {
        static::saving(function ($profile) {
            if (! empty($profile->weight) && ! empty($profile->height) && ! empty($profile->gender) && ! empty($profile->age) && ! empty($profile->activity_level) && ! empty($profile->goal)) {
                $profile->bmi = HealthCalculator::calculateBmi($profile->weight, $profile->height);
                $profile->bmr = HealthCalculator::calculateBmr($profile->gender, $profile->weight, $profile->height, $profile->age);
                $profile->tdee = HealthCalculator::calculateTdee($profile->bmr, $profile->activity_level);
                $profile->daily_calorie_target = HealthCalculator::determineCalorieTarget($profile->tdee, $profile->goal);
            }
        });
    }
}
