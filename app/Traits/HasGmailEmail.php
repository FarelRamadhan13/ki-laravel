<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Query\Builder;

trait HasGmailEmail
{
    public function scopeGmail(Builder $query) {
        return $query->where('email', 'like', '%gmail.com%');
    }
}
