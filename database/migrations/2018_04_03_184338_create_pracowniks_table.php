<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracowniksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pracownicy', function (Blueprint $table) {
            $table->increments('id');
            $table->string("login");
            $table->string("password");
            $table->string("imie");
            $table->string("nazwisko");
            $table->integer("telefon");
            $table->dateTime("data_dolaczenia"); 
            $table->dateTime("ostatnio_aktywny");
            $table->string("status");
            $table->rememberToken();
        });

        DB::insert('insert into pracownicy (id, login, password, imie, nazwisko, telefon, data_dolaczenia, ostatnio_aktywny, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', array(1, "root", bcrypt("root"), "root","root", 000000000, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "kierownik"));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pracownicy');
    }
}
