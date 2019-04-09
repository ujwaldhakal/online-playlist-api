<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsPlayedHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs_played_history', function (Blueprint $table) {
            $table->string('id');
            $table->string('playlist_song_id')->index();
            $table->foreign('playlist_song_id')->references('id')->on('playlist_songs')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('room_id')->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('songs_played_history');
    }
}
