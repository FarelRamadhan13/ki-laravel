<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = ['id', 'created_at'];

    protected $casts = [
        'release_date' => 'datetime'
    ];
}
