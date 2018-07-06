<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlayerHasRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_has_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                  ->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('roles_id')
                  ->unsigned();
            $table->foreign('roles_id')
                  ->references('id')
                  ->on('player_roles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('pools_id')
                  ->unsigned();
            $table->foreign('pools_id')
                  ->references('id')
                  ->on('player_pools')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('player_has_roles');
    }
}
