<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Variable
 * @package App\Models
 * @property StringType $data
 */
class Variable extends Model
{
    protected $casts = [
        'data' => 'array',
    ];
}
