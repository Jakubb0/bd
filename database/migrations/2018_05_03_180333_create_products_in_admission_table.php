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
            $table->foreign('products_in_order_orders_id')->references('products_in_order')->on('orders_id');
            $table->foreign('products_in_order_products_id')->references('products_in_order')->on('products_id');
            $table->foreign('internal_admissions_id')->references('internal_admissions')->on('id');
            $table->foreign('products_in_depots_id')->references('products_in_depots')->on('id');
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
