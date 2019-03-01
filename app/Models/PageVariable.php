<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PageVariable
 *
 * @property int $page_id
 * @property int $key
 * @property mixed $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PageVariable whereType($value)
 */
class PageVariable extends Model
{
    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'key',
        'type',
        'sort',
    ];

    protected $casts = [
        'data' => 'object',
    ];

//    public function setKeyAttribute($value)
//    {
//        if ($value) {
//            $this->incrementing = false;
//        }
//        $this->attributes['key'] = camel_case(str_slug($value, '_'));
//    }
}
