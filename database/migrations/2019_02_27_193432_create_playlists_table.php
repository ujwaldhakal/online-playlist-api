<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->string('name');
            $table->string('slug')->unique();

            $table->string('creator_id')->index();
            $table->foreign('creator_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->tinyInteger('is_youtube_lists')->default(0);

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
        Schema::dropIfExists('playlists');
    }
}
