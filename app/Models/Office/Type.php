<?php

namespace App\Models\Office;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'office__types';

    public function office()
    {
        return $this->belongsToMany(Office::class, OfficeType::class, 'office_type_id', 'office_id', 'id');
    }
}
