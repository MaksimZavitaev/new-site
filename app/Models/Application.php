<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Application
 *
 * @property int $id
 * @property int $page_id
 * @property int $form_id
 * @property mixed $data
 * @property string $user_ip
 * @property string $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereUserIp($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Form $form
 * @property-read \App\Models\Page $page
 * @property int|null $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Application whereProductId($value)
 */
class Application extends Model
{
    protected $casts = [
        'data' => 'object',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
