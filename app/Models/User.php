<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'active_plan_id', 'is_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function customPlans()
    {
        return $this->hasMany(Plan::class)->where('plan_type', 'custom');
    }

    public function dailyLogs()
    {
        return $this->hasMany(DailyLog::class);
    }

    public function rewardPoints()
    {
        return $this->hasMany(RewardPoint::class);
    }

    public function streak()
    {
        return $this->hasOne(UserStreak::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // শুধুমাত্র যাদের is_admin কলামের মান true (১), তারা এডমিন প্যানেলে ঢুকতে পারবে
        return $this->is_admin === true || $this->is_admin === 1;
    }
}
