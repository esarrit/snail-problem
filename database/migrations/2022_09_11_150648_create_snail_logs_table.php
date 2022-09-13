<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This class contains the schema creation logic for the database. Thanks to this logic 
 * and proper database connections, the schema can be defined directly with a single php 
 * command - php artisan migrate. 
 * 
 * This also provides utility to drop the table created using 
 * a php command - php artisan make:migration drop_name_table for a single table or 
 * php artisan migrate:fresh to drop all tables. 
 * 
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Definition of relation schema for storing the snail logs. 
         * 
         * Note: that columns are NOT NULL by default. There is a specific funcion, 
         * (nullable()), to make a column nullable on purpose. 
         * 
         */
        Schema::create('snail_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('DATE', $precision = 0);
            $table->integer('H');
            $table->integer('U');
            $table->integer('D');
            $table->integer('F');
            $table->string('result', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snail_logs');
    }
};
