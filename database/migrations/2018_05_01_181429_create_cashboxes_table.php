<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('openTime');
            $table->dateTime('closeTime');
            $table->integer('employee_id')->unsigned()->nullable();

            $table->foreign('employee_id')->references('id')->on('pracownicy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashboxes');
    }
}
