<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoyalclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalclients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clientCode');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('phone');
            $table->integer('points')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loyalclients');
    }
}
