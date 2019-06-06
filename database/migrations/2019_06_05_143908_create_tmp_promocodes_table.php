<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpPromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_promocodes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('promocode_id');
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->timestamps();
            $table->timestamp('started_at');
            $table->timestamp('ended_at');

            $table->foreign('promocode_id')
                  ->references('id')
                  ->on('promocodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_promocodes');
    }
}
