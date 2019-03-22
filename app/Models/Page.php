<?php

namespace App\Models;

use App\Models\Traits\SoftDeletesWithDeleted;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * Class Page
 *
 * @package App
 * @property array $variables
 * @property int $id
 * @property int $active
 * @property int|null $parent_id
 * @property int $author_id
 * @property string $name
 * @property string $link
 * @property array $seo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read User $author
 * @property mixed $slug
 * @property-read Page|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Page active()
 * @method static \Illuminate\Database\Eloquent\Builder|Page children()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static Builder|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static Builder|Page withTrashed()
 * @method static Builder|Page withoutTrashed()
 * @mixin Eloquent
 * @property-read mixed $status
 * @property mixed|null $breadcrumbs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $childs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereBreadcrumbs($value)
 */
class Page extends Model
{
    use SoftDeletesWithDeleted;

    protected $attributes = [
        'active' => true,
        'parent_id' => null,
    ];

    protected $casts = [
        'seo' => 'array',
        'breadcrumbs' => 'array',
    ];

    protected $fillable = [
        'parent_id',
        'author_id',
        'active',
        'deleted',
        'name',
        'slug',
        'sort',
        'title',
        'seo',
        'breadcrumbs',
    ];

    public function isHome()
    {
        return $this->link === '/';
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Возвращает список переменных
     */
    public function getVariables()
    {
        $variables = $this
            ->variables()
            ->get()
            ->mapToGroups(function ($variable) {
                return [$variable->pivot->key => $variable];
            })->map(function ($variables) {
                $is_list = $variables->first()->pivot->is_list;
                $variables->transform(function ($variable) {
                    return array_merge([
                        'id' => $variable->id,
                        '_sort' => $variable->sort,
                        '_type' => $variable->type,
                    ], $variable->data);
                });

                return $is_list ? $variables : $variables->first();
            });
        return array2object($variables->toArray());
    }

    /**
     * Возвращает все переменные страницы
     */
    public function variables()
    {
        return $this
            ->belongsToMany(Variable::class, 'pages_variables', 'page_id', 'id', 'id', 'page_variable_id')
            ->withPivot(['key', 'is_list'])
            ->orderBy('pages_variables.sort');
    }

    public function scopeChildren($query)
    {
        return $query->where('parent_id', $this->id);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getStatusAttribute()
    {
        if ($this->deleted_at) {
            return 'Удалена';
        }

        if (!$this->active) {
            return 'Не активна';
        }

        return 'Активна';
    }

    public function getSlugAttribute()
    {
        $link = rtrim($this->attributes['link'], '/');
        return substr($link, strrpos($link, '/') + 1);
    }

    public function setSlugAttribute($value)
    {
        $parent = $this->attributes['parent_id'];
        $link = $parent ? self::find($parent)->link : '/';
        $slug = str_slug($value);
        $this->attributes['link'] = rtrim($link, '/') . '/' . $slug;
    }

    public function getBreadcrumbs()
    {
        if ($this->breadcrumbs !== null) {
            return $this->breadcrumbs;
        }
        $chain = $this->getParentsChain();
        return $chain->map(function ($item) {
            return [
                'title' => $item->name,
                'link' => $item->link,
            ];
        });
    }

    protected function getParentsChain()
    {
        $chain = collect()->push($this);
        $model = $this;

        while ($model = $model->parent) {
            $chain->push($model);
        }

        return $chain->reverse();
    }
}
