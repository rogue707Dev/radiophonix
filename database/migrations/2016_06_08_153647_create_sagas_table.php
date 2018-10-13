<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Radiophonix\Models\Saga;

class CreateSagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sagas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();

            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->string('name');
            $table->text('synopsis')->nullable()->default(null);
            $table->date('creation_date')->nullable()->default(null);
            $table->string('licence')->nullable()->default(null);

            $table->string('link_netowiki')->nullable()->default(null);
            $table->string('link_site')->nullable()->default(null);
            $table->string('link_topic')->nullable()->default(null);
            $table->string('link_rss')->nullable()->default(null);
            $table->string('link_facebook')->nullable()->default(null);
            $table->string('link_twitter')->nullable()->default(null);

            $table->boolean('finished')->default(false);
            $table->integer('visibility')->default(Saga::VISIBILITY_PRIVATE);

            $table->dateTime('last_publish_at')->nullable()->default(null);

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
        Schema::drop('sagas');
    }
}
