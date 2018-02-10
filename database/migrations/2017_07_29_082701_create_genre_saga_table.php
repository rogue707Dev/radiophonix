<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreSagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_saga', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');

            $table->integer('saga_id')->unsigned();
            $table->foreign('saga_id')->references('id')->on('sagas');

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
        Schema::dropIfExists('genre_saga');
    }
}
