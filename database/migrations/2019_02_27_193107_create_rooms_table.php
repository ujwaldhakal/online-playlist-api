<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();

            $table->string('creator_id')->index();
            $table->foreign('creator_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('dj_id')->index();
            $table->foreign('dj_id')->references('id')->on('users')
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
        Schema::dropIfExists('rooms');
    }
}
