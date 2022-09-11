<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
         * Definition of relation schema. 
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
