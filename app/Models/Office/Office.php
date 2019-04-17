<?php

namespace App\Models\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Office extends Model
{
    protected $table = 'office__offices';

    protected $fillable = [
        'active',
        'address',
        'address_note',
        'lat',
        'lon',
        'sort',
    ];

    public function getTypesFlatMap(): Collection
    {
        return $this
            ->types
            ->map(function ($item) {
                return [
                    'id' => $item->pivot->id,
                    'office_id' => $item->pivot->office_id,
                    'office_type_id' => $item->pivot->office_type_id,
                    'name' => $item->name,
                    'seo' => $item->pivot->seo,
                    'schedule' => $item->pivot->schedule,
                    'phones' => $item->pivot->phones,
                    'emails' => $item->pivot->emails,
                    'vip' => $item->pivot->vip,
                    'main' => $item->pivot->main,
                    'master' => $item->pivot->master,
                    'card' => $item->pivot->card,
                    'delimobil' => $item->pivot->delimobil,
                ];
            });
    }

    public function types()
    {
        return $this
            ->belongsToMany(Type::class, OfficeType::class, 'office_id', 'office_type_id', 'id')
            ->withPivot(['id', 'seo', 'schedule', 'phones', 'emails', 'vip', 'main', 'master', 'card', 'delimobil']);
    }
}
