<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->unsignedInteger('form_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->json('data');
            $table->string('user_ip');
            $table->string('user_agent');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
