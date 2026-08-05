<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use Auditable;

    protected $fillable = [
        'name',
        'calories_burn_per_minute',
        'difficulty',
        'instruction',
    ];
}
