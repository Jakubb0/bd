<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsInAdmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_in_admission', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('products_in_order_orders_id')->unsigned();
            $table->integer('products_in_order_products_id')->unsigned();
            $table->integer('internal_admissions_id')->unsigned();
            $table->integer('products_in_depots_id')->unsigned();
            $table->foreign('products_in_order_orders_id')->references('orders_id')->on('products_in_order');
            $table->foreign('products_in_order_products_id')->references('products_id')->on('products_in_order');
            $table->foreign('internal_admissions_id')->references('id')->on('internal_admissions');
            $table->foreign('products_in_depots_id')->references('id')->on('products_in_depots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_in_admission');
    }
}
