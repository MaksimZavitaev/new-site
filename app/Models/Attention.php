<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Attention extends Model
{
    public $timestamps = false;

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    public function scopeStarted(Builder $query)
    {
        return $query->where('started_at', '>', Carbon::now());
    }

    public function scopeNotEnded(Builder $query)
    {
        return $query->where('ended_at', '<', Carbon::now());
    }
}
