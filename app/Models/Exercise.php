<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'name',
        'calories_burn_per_minute',
        'difficulty',
        'instruction',
    ];
}
