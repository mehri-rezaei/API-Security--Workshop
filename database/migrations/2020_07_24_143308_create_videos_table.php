<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatevideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->string('video_id');
        $table->string('name');
        $table->string('director');
        $table->integer('year');
        $table->string('genre');
        $table->timestamps();
        $table->string('url');
        $table->string('trailer');
        $table->uuid('user_id');
        $table->BigInteger('channel_id');

        $table->foreign('channel_id')->references('channel_id')->on('channels')
            ->onDelete('cascade')->onUpdate('cascade');
       //


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
