<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'order_number',
        'amount',
        'user_email',
        'doc_id',
        'pay_id',
        'pay_url',
        'pay_completed',
        'data',
        'seo',
        'files',
        'insured_ids',
        'form_filled',
        'alpha_id',
        'alpha_pay',
        'alpha_check',
        'policy_number',
        'policy_begin_at',
        'policy_end_at',
        'finished',
        'ad_uid',
        'promocode',
        'checkpoint',
    ];

    protected $casts = [
        'data'        => 'object',
        'seo'         => 'array',
        'files'       => 'array',
        'insured_ids' => 'array',
        'form_filled' => 'boolean',
        'alpha_check' => 'boolean',
        'finished'    => 'boolean',
    ];
}
