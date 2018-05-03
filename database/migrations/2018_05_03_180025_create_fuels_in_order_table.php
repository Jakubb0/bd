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
            $table->integer('orders_id')->unassigned();
            $table->integer('fuels_id')->unassigned();
            $table->float('buying_price');
            $table->float('amount');
            $table->foreign('orders_id')->references('orders')->on('id');
            $table->foreign('fuels_id')->references('fuels')->on('id');
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
