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
            $table->string("name");
            $table->string("surname");
            $table->integer("phone");
            $table->dateTime("join_date"); 
            $table->dateTime("login_date");
            $table->string("status");
            $table->rememberToken();
        });

        DB::insert('insert into pracownicy (id, login, password, name, surname, phone, join_date, login_date, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', array(1, "root", bcrypt("root"), "root","root", 000000000, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), "kierownik"));

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
