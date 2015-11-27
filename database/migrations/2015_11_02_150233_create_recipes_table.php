<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE recipes (
                id INTEGER PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) UNIQUE NOT NULL,
                body TEXT NOT NULL
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            DROP TABLE recipes
        ");
    }
}
