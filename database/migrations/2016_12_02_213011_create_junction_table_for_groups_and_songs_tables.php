<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJunctionTableForGroupsAndSongsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_songs', function (Blueprint $table) {
            
            $table->integer('groups_id');
            $table->integer('songs_id');
            $table->primary(['groups_id', 'songs_id']);

            $table->foreign('groups_id')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('songs_id')
                ->references('id')->on('songs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups_songs');
    }
}
