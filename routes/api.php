<?php

use Radiophonix\Http\Controllers\Api\V1\Auth\LoginUser;
use Radiophonix\Http\Controllers\Api\V1\Auth\RefreshToken;
use Radiophonix\Http\Controllers\Api\V1\Auth\RegisterUser;
use Radiophonix\Http\Controllers\Api\V1\Author\ListAuthors;
use Radiophonix\Http\Controllers\Api\V1\Author\ListAuthorSagas;
use Radiophonix\Http\Controllers\Api\V1\Author\ShowAuthor;
use Radiophonix\Http\Controllers\Api\V1\Collection\ListCollectionTracks;
use Radiophonix\Http\Controllers\Api\V1\Collection\ShowCollection;
use Radiophonix\Http\Controllers\Api\V1\Genre\ListGenres;
use Radiophonix\Http\Controllers\Api\V1\Genre\ShowGenre;
use Radiophonix\Http\Controllers\Api\V1\Like\ListUserLikes;
use Radiophonix\Http\Controllers\Api\V1\Like\Saga;
use Radiophonix\Http\Controllers\Api\V1\Saga\ListSagaCollections;
use Radiophonix\Http\Controllers\Api\V1\Saga\ListSagas;
use Radiophonix\Http\Controllers\Api\V1\Saga\ShowSaga;
use Radiophonix\Http\Controllers\Api\V1\Search\SearchAll;
use Radiophonix\Http\Controllers\Api\V1\Team\ListTeams;
use Radiophonix\Http\Controllers\Api\V1\Team\ListTeamSagas;
use Radiophonix\Http\Controllers\Api\V1\Team\ShowTeam;
use Radiophonix\Http\Controllers\Api\V1\Track\ShowTrack;
use Radiophonix\Http\Controllers\Api\V1\User\ShowProfile;

Route::post('/search', SearchAll::class);

Route::get('/sagas', ListSagas::class);

//Route::group(['middleware' => 'saga.visible'], function () {
    Route::get('/sagas/{saga}', ShowSaga::class);
    Route::get('/sagas/{saga}/collections', ListSagaCollections::class);

    Route::get('/collections/{collection}', ShowCollection::class);
    Route::get('/collections/{collection}/tracks', ListCollectionTracks::class);

    Route::get('/tracks/{track}', ShowTrack::class);
//});

//Route::get('/ticks');

Route::get('/genres', ListGenres::class);
Route::get('/genres/{genre}', ShowGenre::class);

Route::get('/authors', ListAuthors::class);
Route::get('/authors/{author}', ShowAuthor::class);
Route::get('/authors/{author}/sagas', ListAuthorSagas::class);

Route::get('/teams', ListTeams::class);
Route::get('/teams/{team}', ShowTeam::class);
Route::get('/teams/{team}/sagas', ListTeamSagas::class);

// Profiles

Route::get('/profile/{user}', ShowProfile::class);

// WIP authentification

Route::post('/auth/register', RegisterUser::class);
Route::post('/auth/login', LoginUser::class)->name('login');
Route::get('/auth/refresh', RefreshToken::class);

///*
Route::group(['middleware' => ['jwt.auth']], function () {
    // Auth
//    Route::post('/logout', 'AuthController@logout');
//    Route::post('/refresh', 'AuthController@refresh');
//
//    // Current user
//    Route::get('/me', ShowCurrentUser::class);
//    Route::get('/notifications', ListUserNotifications::class);
//    Route::put('/notifications/{notification}', MarkNotificationAsRead::class);
//    Route::delete('/notifications/{notification}', DestroyNotification::class);
//
//    // Teams
//    Route::post('/teams', StoreTeam::class);
//    Route::put('/teams/{team}', UpdateTeam::class);
//    Route::delete('/teams/{team}', DestroyTeam::class);
//
//    // Teams invites
//    Route::get('/invites', ListInvites::class);
//    Route::get('/teams/{team}/invites', ListTeamPendingInvites::class);
//    Route::post('/teams/{team}/invites', SendInvite::class);
//    Route::put('/invites/{invite}', AcceptInvite::class);
//    Route::delete('/invites/{invite}', DeclineInvite::class);
//
//    // Sagas
//    Route::post('/sagas', StoreSaga::class);
//    Route::group(['middleware' => ['saga.visible', 'saga.owner']], function () {
//        Route::put('/sagas/{saga}', UpdateSaga::class);
//        Route::delete('/sagas/{saga}', DestroySaga::class);
//    });

    // Likes
    Route::get('/likes', ListUserLikes::class);
    Route::post('/likes/saga/{saga}', Saga\AddLike::class);
    Route::delete('/likes/saga/{saga}', Saga\RemoveLike::class);

//    // Subscriptions
//    Route::get('/subscriptions', ListUserSubscriptions::class);
//    Route::post('/sagas/{saga}/subscriptions', SubscribeToSaga::class);
//    Route::delete('/sagas/{saga}/subscriptions', UnsubscribeToSaga::class);
//
//    // Collections
//    Route::group(['middleware' => ['saga.visible', 'saga.owner']], function () {
//        Route::post('/sagas/{saga}/collections', StoreCollection::class);
//        Route::put('/collections/{collection}', UpdateCollection::class);
//        Route::delete('/collections/{collection}', DestroyCollection::class);
//    });
//
//    // Tracks
//    Route::group(['middleware' => ['saga.owner', 'saga.visible']], function () {
//        Route::post('/collections/{collection}/tracks', StoreTrack::class);
//        Route::put('/tracks/{track}', UpdateTrack::class);
//        Route::delete('/tracks/{track}', DestroyTrack::class);
//        Route::post('/tracks/{track}/upload', 'UploadController@track');
//    });
//
//    // Audio player
//    Route::get('/ticks', ListTicks::class);
//    Route::get('/ticks/current', CurrentTick::class);
//    Route::get('/ticks/{saga}', ShowTickForSaga::class);
//    Route::group(['middleware' => 'throttle:10,1'], function () {
//        Route::post('/ticks/{track}', SaveTick::class);
//    });
});

//*/
