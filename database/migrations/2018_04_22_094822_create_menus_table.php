<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('url');
            $table->string('icon');
            $table->integer('size');
        });


        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Kasa", "Cash", "cart-arrow-down","12", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Produkty", "Product", "shopping-basket","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Sprawdź cenę", "CheckPrice", "dollar-sign","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Numer stałego klienta", "CustomerNumber", "id-card","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Faktury", "Invoices", "file-alt","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Zamówienia", "Orders", "shipping-icon","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));

        DB::insert('INSERT INTO menus (name, url, icon, size, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', array("Wezwij kierownika", "CallManager", "male","6", date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
