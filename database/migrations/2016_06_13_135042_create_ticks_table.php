<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticks', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('saga_id');
            $table->foreign('saga_id')->references('id')->on('sagas')->onDelete('cascade');

            $table->unsignedInteger('track_id');
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');

            $table->integer('seconds');
            $table->boolean('finished');

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
        Schema::drop('ticks');
    }
}
