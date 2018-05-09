<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depots', function (Blueprint $table) {
            $table->increments('id');
<<<<<<< HEAD
<<<<<<< HEAD
=======
            $table->timestamps();
>>>>>>> 17d82192b00c6af2e5145b83e7856f6e6d14680a
=======
>>>>>>> parent of afbdd60... Revert "Update 1.4.5 - added depot"
            $table->string('name');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depots');
    }
}
