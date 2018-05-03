<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('products_in_depots', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('products_id')->unsigned();
            $table->integer('amount_in_depot');
            $table->integer('depots_id')->unsigned();
            $table->foreign('products_id')->references('products')->on('id');
            $table->foreign('depots_id')->references('depots')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_in_depots');
    }
}
