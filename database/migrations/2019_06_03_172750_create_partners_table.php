<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(true);
            $table->string('pid')->unique();
            $table->string('name');
            $table->string('ikp');
            $table->string('ikp2')->nullable();
            $table->string('ikp_commission')->nullable();
            $table->string('ikp2_commission')->nullable();
            $table->string('subuser')->nullable();
            $table->string('promocode')->nullable();
            $table->unsignedInteger('product_id');
            $table->boolean('promocode_disable')->default(false);
            $table->string('discount');
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
