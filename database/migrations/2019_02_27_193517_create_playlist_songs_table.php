<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_songs', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->string('link');

            $table->string('creator_id')->index();
            $table->foreign('creator_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('playlist_id')->index();
            $table->foreign('playlist_id')->references('id')->on('playlists')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->tinyInteger('is_youtube_playlist_link')->default(0);
            $table->tinyInteger('is_youtube_list')->default(0);

            $table->tinyInteger('is_played');
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
        Schema::dropIfExists('playlist_songs');
    }
}
