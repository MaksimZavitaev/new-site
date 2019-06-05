<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('partner_id');
            $table->string('status');
            $table->string('order_number');
            $table->string('amount');
            $table->string('user_email');
            $table->string('doc_id');
            $table->string('pay_id');
            $table->string('pay_url');
            $table->boolean('pay_completed')->default(false);
            $table->json('data');
            $table->json('seo');
            $table->json('files');
            $table->json('insured_ids');
            $table->boolean('form_filled')->default(false);
            $table->string('alpha_id');
            $table->string('alpha_pay');
            $table->boolean('alpha_check')->default(false);
            $table->string('policy_number');
            $table->timestamp('policy_begin_at');
            $table->timestamp('policy_end_at');
            $table->boolean('finished')->default(false);
            $table->string('ad_uid');
            $table->string('promocode');
            $table->text('checkpoint');
            $table->timestamps();
            $table->dateTime('ended_at');

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');

            $table->foreign('partner_id')
                  ->references('id')
                  ->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
