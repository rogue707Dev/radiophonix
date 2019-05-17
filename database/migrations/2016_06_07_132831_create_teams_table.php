<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->string('slug')->unique();

            $table->string('name');
            $table->text('bio')->nullable();

            $table->string('link_netowiki')->nullable()->default(null);
            $table->string('link_site')->nullable()->default(null);
            $table->string('link_facebook')->nullable()->default(null);
            $table->string('link_twitter')->nullable()->default(null);

            $table->integer('owner_id')->unsigned()->index()->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('teams');
    }
}
