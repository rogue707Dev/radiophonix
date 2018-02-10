<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Radiophonix\Models\Collection;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('saga_id');
            $table->foreign('saga_id')->references('id')->on('sagas')->onDelete('cascade');

            $table->string('number')->default('1');

            $table->string('name');
            $table->text('synopsis')->nullable();
            $table->string('type')->default('Saison');

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
        Schema::drop('collections');
    }
}
