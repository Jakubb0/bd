<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('pracownicy_id')->unsigned();
            $table->integer('orders_id')->unsigned();
            $table->foreign('pracownicy_id')->references('pracownicy')->on('id');
            $table->foreign('orders_id')->references('orders')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_admissions');
    }
}
