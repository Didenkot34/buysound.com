<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJunctionTableForSongsAndStylesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs_styles', function (Blueprint $table) {

            $table->integer('songs_id');
            $table->integer('styles_id');
            $table->primary(['songs_id', 'styles_id']);

            $table->foreign('songs_id')
                ->references('id')->on('songs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('styles_id')
                ->references('id')->on('styles')
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
        Schema::drop('songs_styles');
    }
}
