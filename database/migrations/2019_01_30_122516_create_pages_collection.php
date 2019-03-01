<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mongo = Schema::connection('mongodb');
        $mongo->create('pages', function (Blueprint $table) {
            $table->unique('link');
            $table->index('variables.key');
            $table->timestamps();
            $table->softDeletes();
        });

        \App\Models\Page::create([
            'name' => 'Главная',
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_collection');
    }
}
