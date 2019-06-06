<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmpPromocode extends Model
{
    protected $fillable = [
        'active',
        'promocode_id',
        'name',
        'started_at',
        'ended_at',
    ];

    protected $dates = [
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Promocode::class, 'promocode_id');
    }
}
