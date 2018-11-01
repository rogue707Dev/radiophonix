<?php

use Radiophonix\Http\Controllers\Rss;

Route::get('/{saga}', Rss\GetSaga::class)->name('rss.saga');
