<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'name' => 'Главная',
            'active' => true,
            'author_id' => 1,
            'slug' => '',
            'seo' => [
                'title' => 'Главная страница',
                'keywords' => 'Согласие, Главная',
                'description' => 'Описание главной страницы',
                'h1' => 'h1 главной',
                'alt' => 'Alt главной',
            ],
        ]);
    }
}
