<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPageVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('page_variables');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('page_variables', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
            $table->string('key');
            $table->string('type');
            $table->tinyInteger('sort')->unsigned()->default(0);
            $table->json('data');
            $table->timestamps();

            $table->primary(['page_id', 'key']);
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }
}
