<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductType
 *
 * @property int $id
 * @property string|null $code
 * @property int $diasoft_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereDiasoftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 */
class ProductType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'diasoft_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id');
    }
}
