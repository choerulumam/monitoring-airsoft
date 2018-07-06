<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGamePlays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameplays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pools_id')
                  ->unsigned();
            $table->foreign('pools_id')
                  ->references('id')
                  ->on('player_pools')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('match_rules_id')
                  ->unsigned();
            $table->foreign('match_rules_id')
                  ->references('id')
                  ->on('match_rules')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('game_locations_id')
                  ->unsigned();
            $table->foreign('game_locations_id')
                  ->references('id')
                  ->on('game_locations')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->date('game_start_date');
            $table->date('game_finish_date');
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
        Schema::dropIfExists('gameplays');
    }
}
