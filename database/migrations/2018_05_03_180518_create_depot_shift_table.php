<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepotShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot_shift', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('products_id')->unsigned();
            $table->integer('products_in_depots_id')->unsigned();
            $table->integer('amount');
            $table->integer('pracownicy_id')->unsigned();
            $table->foreign('products_id')->references('products')->on('id');
            $table->foreign('products_in_depots_id')->references('products_in_depots')->on('id');
            $table->foreign('pracownicy_id')->references('pracownicy')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depot_shift');
    }
}
