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
    public $timestamps = false;

    protected $casts = [
        'data' => 'array',
    ];

    protected $types = [
        'string' => [
            'value' => '',
        ],
        'text' => [
            'value' => '',
        ],
        'link' => [
            'href' => '',
            'text' => '',
            'blank' => false,
        ],
        'image' => [
            'url' => '',
            'size' => '',
            'path' => '',
        ],
        'file' => [
            'url' => '',
            'size' => '',
            'path' => '',
            'update_at' => '',
        ],
    ];

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        $data = parent::castAttribute($key, $value);
        if ($key === 'data') {
            $fields = $this->types[$this->type];
            foreach ($data as $k => $v) {
                if (!isset($fields[$k])) {
                    unset($data[$k]);
                }
            }
            $data = array_merge($fields, $data);
        }
        return $data;
    }
}
