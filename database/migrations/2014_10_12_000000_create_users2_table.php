<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password', 60);
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
        Schema::create('users2', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->integer('age')->nullable();
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('users');
        Schema::drop('users2');
    }
}
