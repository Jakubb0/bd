<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('transactions_id')->unsigned();
            $table->integer('invoices_id')->unsigned();
            $table->foreign('transactions_id')->references('transactions')->on('id');
            $table->foreign('invoices_id')->references('invoices')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_invoices');
    }
}
