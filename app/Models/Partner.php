<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'active',
        'pid',
        'name',
        'ikp',
        'ikp2',
        'ikp_commission',
        'ikp2_commission',
        'subuser',
        'promocode',
        'promocode_disable',
        'discount',
    ];

    protected $casts = [
        'active'             => 'boolean',
        'promocode_disabled' => 'boolean',
    ];
}
