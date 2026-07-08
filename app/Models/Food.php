<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = ['name', 'category', 'calories', 'protein', 'carbohydrate', 'fat', 'fiber', 'suger', 'serving_size', 'is_admin_approved'];
}
