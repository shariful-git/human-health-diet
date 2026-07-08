<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseLog extends Model
{
    protected $fillable = ['daily_log_id', 'exercise_id', 'duration_minutes', 'calculated_calories_burn', 'is_completed'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function dailyLog()
    {
        return $this->belongsTo(DailyLog::class);
    }

    protected static function booted()
    {
        static::saved(function ($exerciseLog) {
            $exerciseLog->dailyLog->update([
                'total_calories_burn' => $exerciseLog->dailyLog->exerciseLogs()->sum('calculated_calories_burn')
            ]);
        });

        static::deleted(function ($exerciseLog) {
            $exerciseLog->dailyLog->update([
                'total_calories_burn' => $exerciseLog->dailyLog->exerciseLogs()->sum('calculated_calories_burn')
            ]);
        });
    }
}