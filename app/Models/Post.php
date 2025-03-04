<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'user_id',
        'slug',
        'description',
        'image',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
