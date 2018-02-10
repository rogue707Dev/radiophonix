<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('invited_id')->unsigned()->index();
            $table->foreign('invited_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('inviting_id')->unsigned()->index();
            $table->foreign('inviting_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('team_id')->unsigned()->index();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->boolean('accepted')->default(false);

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
        Schema::drop('invites');
    }
}
