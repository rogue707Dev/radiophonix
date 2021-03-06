<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Radiophonix\Models\Track;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();

            $table->unsignedInteger('album_id')->nullable();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

            $table->string('number')->default('1');

            $table->string('title')->nullable();
            $table->text('synopsis')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('status')->default(Track::STATUS_DRAFT);
            $table->integer('length')->default(0);
            $table->string('url')->nullable();

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
        Schema::drop('tracks');
    }
}
