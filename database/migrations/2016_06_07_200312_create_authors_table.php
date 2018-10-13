<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();

            $table->string('name');
            $table->text('bio')->nullable();

            $table->string('link_netowiki')->nullable()->default(null);
            $table->string('link_site')->nullable()->default(null);
            $table->string('link_topic')->nullable()->default(null);
            $table->string('link_facebook')->nullable()->default(null);
            $table->string('link_twitter')->nullable()->default(null);

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('authors');
    }
}
