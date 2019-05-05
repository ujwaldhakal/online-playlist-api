<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_queues', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->string('playlist_id')->index();
            $table->foreign('playlist_id')->references('id')->on('playlists')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('room_id')->index();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('is_playing');

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
        Schema::dropIfExists('playlist_queue');
    }
}
