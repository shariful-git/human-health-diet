<?php

namespace App\Services;

use App\Models\User;
use App\Models\RewardPoint;
use App\Models\UserStreak;
use Carbon\Carbon;

class RewardStreakService
{
    public static function awardPoints(User $user, string $actionType)
    {
        $pointsMatrix = [
            'meal_complete'     => 5,
            'exercise_complete' => 10,
            'complete_day'      => 20,
            'complete_week'     => 100,
            'complete_plan'     => 500,
        ];

        $points = $pointsMatrix[$actionType] ?? 0;
        $reason = ucwords(str_replace('_', ' ', $actionType));

        if ($points > 0) {
            RewardPoint::create([
                'user_id' => $user->id,
                'points'  => $points,
                'reason'  => $reason,
            ]);
        }
    }

    public static function updateStreak(User $user)
    {
        $streak = UserStreak::firstOrCreate(
            ['user_id' => $user->id],
            ['current_streak' => 0, 'longest_streak' => 0, 'last_activity_date' => null]
        );

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($streak->last_activity_date) {
            $lastActive = Carbon::parse($streak->last_activity_date);

            if ($lastActive->equalTo($today)) {
                return;
            } elseif ($lastActive->equalTo($yesterday)) {
                $streak->current_streak += 1;
            } else {
                $streak->current_streak = 1;
            }
        } else {
            $streak->current_streak = 1;
        }

        if ($streak->current_streak > $streak->longest_streak) {
            $streak->longest_streak = $streak->current_streak;
        }

        $streak->last_activity_date = $today->toDateString();
        $streak->save();
    }
}
