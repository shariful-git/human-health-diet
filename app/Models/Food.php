<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use Auditable;

    protected $table = 'foods';

    protected $fillable = ['user_id', 'name', 'category', 'calories', 'protein', 'carbohydrate', 'fat', 'fiber', 'sugar', 'sodium', 'vitamins', 'minerals', 'serving_size', 'is_admin_approved'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAvailableForUser($query, array $userIds)
    {
        return $query->where(function ($q) use ($userIds) {
            $q->orWhereIn('user_id', $userIds);
        });
    }
}
