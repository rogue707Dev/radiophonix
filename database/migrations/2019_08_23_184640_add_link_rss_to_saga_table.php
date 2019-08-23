<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkRssToSagaTable extends Migration
{
    public function up()
    {
        Schema::table('sagas', function (Blueprint $table) {
            $table->string('link_rss')
                ->nullable()
                ->default(null)
                ->after('link_twitter');
        });
    }
}
