<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GameplayLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameplay_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                  ->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('device_id')
                  ->unsigned();
            $table->foreign('device_id')
                  ->references('id')
                  ->on('devices')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->boolean('status')
                  ->nullable();
            $table->integer('score')
                  ->nullable();
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
        Schema::dropIfExists('gameplay_logs');
    }
}
