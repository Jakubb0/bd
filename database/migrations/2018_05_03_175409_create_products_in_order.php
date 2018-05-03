<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_in_order', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('orders_id')->unsigned();
            $table->integer('products_id')->unsigned();
            $table->float('buying_price');
            $table->integer('amount');
            $table->foreign('orders_id')->references('orders')->on('id');
            $table->foreign('products_id')->references('products')->on('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_in_order');
    }
}
