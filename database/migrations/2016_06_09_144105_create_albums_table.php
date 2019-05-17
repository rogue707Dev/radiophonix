<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Radiophonix\Models\Album;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();

            $table->unsignedInteger('saga_id');
            $table->foreign('saga_id')->references('id')->on('sagas')->onDelete('cascade');

            $table->string('number')->default('1');

            $table->string('name');
            $table->text('synopsis')->nullable();
            $table->string('type')->default('season');

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
        Schema::drop('albums');
    }
}
