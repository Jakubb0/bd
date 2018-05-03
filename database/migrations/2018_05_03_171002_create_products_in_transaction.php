<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_in_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('transactions_id')->unsigned();
            $table->integer('products_id')->unsigned();
            $table->integer('amount');
            $table->foreign('transactions_id')->references('transactions')->on('id');
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
        Schema::dropIfExists('products_in_transaction');
    }
}
