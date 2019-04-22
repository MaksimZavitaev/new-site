<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subway extends Model
{
    protected $fillable = [
        'line',
        'station',
    ];

    public $timestamps = false;

    public static function getSubwayLines()
    {
        return [
            [
                'line' => '1',
                'color' => 'red',
                'name' => 'Сокольническая',
            ],
            [
                'line' => '2',
                'color' => 'green',
                'name' => 'Замоскворецкая',
            ],
            [
                'line' => '3',
                'color' => 'blue',
                'name' => 'Арбатско-Покровская',
            ],
            [
                'line' => '4',
                'color' => 'lightblue',
                'name' => 'Филёвская',
            ],
            [
                'line' => '5',
                'color' => 'brown',
                'name' => 'Кольцевая',
            ],
            [
                'line' => '6',
                'color' => 'orange',
                'name' => 'Калужско-Рижская',
            ],
            [
                'line' => '7',
                'color' => 'purple',
                'name' => 'Таганско-Краснопресненская',
            ],
            [
                'line' => '8',
                'color' => 'yellow',
                'name' => 'Калининская',
            ],
            [
                'line' => '8A',
                'color' => 'yellow',
                'name' => 'Солнцевская',
            ],
            [
                'line' => '9',
                'color' => 'gray',
                'name' => 'Серпуховско-Тимерязевская',
            ],
            [
                'line' => '10',
                'color' => 'lime',
                'name' => 'Люблинско-Дмитровская',
            ],
            [
                'line' => '11',
                'color' => 'teal',
                'name' => 'Большая кольцевая',
            ],
            [
                'line' => '11A',
                'color' => 'teal',
                'name' => 'Каховская',
            ],
            [
                'line' => '12',
                'color' => 'gray-blue',
                'name' => 'Бутовская',
            ],
            [
                'line' => '15',
                'color' => 'pink',
                'name' => 'Некрасовская',
            ],
        ];
    }
}
