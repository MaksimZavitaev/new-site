<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office__offices', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->text('address');
            $table->text('address_note')->nullable();
            $table->string('lat');
            $table->string('lon');
            $table->unsignedSmallInteger('sort');
            $table->timestamps();
        });

        Schema::create('office__types', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
        });

        Schema::create('office__offices_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('office_id');
            $table->unsignedTinyInteger('office_type_id');
            $table->string('slug')->nullable()->index();
            $table->text('address_note')->nullable();
            $table->json('seo');
            $table->json('schedule');
            $table->json('phones');
            $table->json('emails');
            $table->boolean('vip')->default(false);
            $table->boolean('main')->default(false);
            $table->boolean('master')->default(false);
            $table->boolean('card')->default(false);
            $table->boolean('delimobil')->default(false);

            $table->foreign('office_id')
                ->references('id')
                ->on('office__offices')
                ->onDelete('cascade');

            $table->foreign('office_type_id')
                ->references('id')
                ->on('office__types')
                ->onDelete('cascade');
        });

        Schema::create('subways', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('line');
            $table->string('station');
        });

        Schema::create('office__offices_subways', function (Blueprint $table) {
            $table->unsignedInteger('office_id');
            $table->unsignedSmallInteger('subway_id');

            $table->foreign('office_id')
                ->references('id')
                ->on('office__offices')
                ->onDelete('cascade');

            $table->foreign('subway_id')
                ->references('id')
                ->on('subways')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office__offices_subways');
        Schema::dropIfExists('subways');
        Schema::dropIfExists('office__offices_types');
        Schema::dropIfExists('office__office_types');
        Schema::dropIfExists('office__offices');
    }
}
