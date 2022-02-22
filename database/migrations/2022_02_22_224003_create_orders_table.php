<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_statuses_id');
            $table->unsignedBigInteger('payment_id');
            $table->uuid('uuid');
            $table->json('products');
            $table->json('address');
            $table->float('delivery_fee');
            $table->float('amount');
            $table->timestamp('shipped_at');


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_statuses_id')->references('id')->on('order_statuses');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->timestamps();
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
