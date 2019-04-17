<?php

namespace App\Models\Office;

use Illuminate\Database\Eloquent\Model;

class OfficeType extends Model
{
    protected $table = 'office__offices_types';

    public $timestamps = false;

    protected $casts = [
        'seo' => 'object',
        'schedule' => 'array',
        'phones' => 'array',
        'emails' => 'array',
    ];

    protected $fillable = [
        'address_note',
        'seo',
        'schedule',
        'phones',
        'emails',
        'vip',
        'main',
        'master',
        'card',
        'delimobil',
    ];
}
