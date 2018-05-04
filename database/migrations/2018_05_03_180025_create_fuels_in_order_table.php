<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelsInOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels_in_order', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('orders_id')->unsigned();
            $table->integer('fuels_id')->unsigned();
            $table->float('buying_price');
            $table->float('amount');
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->foreign('fuels_id')->references('id')->on('fuels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuels_in_order');
    }
}
