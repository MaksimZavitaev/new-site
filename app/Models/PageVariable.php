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
    protected $table = 'pages_variables';

    public $timestamps = false;

    protected $fillable = [
        'key',
        'sort',
    ];

    public function variables()
    {
        return $this->hasMany(Variable::class);
    }
}
