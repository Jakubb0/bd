<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('sum');
            $table->integer('client_id')->unsigned();
            $table->integer('loyalclients_id')->unsigned();
            $table->integer('distributor_id')->unsigned();
            $table->enum('payment_method',['cash','credit_card']);
            $table->enum('proof',['receipt','invoice']);
            $table->integer('cashboxes_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('loyalclients_id')->references('id')->on('loyalclients');
            $table->foreign('distributor_id')->references('id')->on('distributors');
            $table->foreign('cashboxes_id')->references('id')->on('cashboxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
