<?php

use Radiophonix\Http\Controllers\Api\V1;

Route::post('/search', V1\Search\SearchAll::class);

Route::get('/sagas', V1\Saga\ListSagas::class);

//Route::group(['middleware' => 'saga.visible'], function () {
    Route::get('/sagas/{saga}', V1\Saga\ShowSaga::class);
    Route::get('/sagas/{saga}/collections', V1\Saga\ListSagaCollections::class);

    Route::get('/collections/{collection}', V1\Collection\ShowCollection::class);
    Route::get('/collections/{collection}/tracks', V1\Collection\ListCollectionTracks::class);

    Route::get('/tracks/{track}', V1\Track\ShowTrack::class);
//});

Route::get('/genres', V1\Genre\ListGenres::class);
Route::get('/genres/{genre}', V1\Genre\ShowGenre::class);

Route::get('/authors', V1\Author\ListAuthors::class);
Route::get('/authors/{author}', V1\Author\ShowAuthor::class);
Route::get('/authors/{author}/sagas', V1\Author\ListAuthorSagas::class);

Route::get('/teams', V1\Team\ListTeams::class);
Route::get('/teams/{team}', V1\Team\ShowTeam::class);
Route::get('/teams/{team}/sagas', V1\Team\ListTeamSagas::class);

// Profiles

Route::get('/profile/{user}', V1\User\ShowProfile::class);
Route::get('/profile/{user}/likes', V1\User\ShowProfileLikes::class);

// WIP authentification

Route::post('/auth/register', V1\Auth\RegisterUser::class);
Route::post('/auth/login', V1\Auth\LoginUser::class)->name('login');
Route::get('/auth/refresh', V1\Auth\RefreshToken::class);

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
    Route::get('/likes', V1\Like\ListUserLikes::class);
    Route::post('/likes/saga/{saga}', V1\Like\Saga\AddLike::class);
    Route::delete('/likes/saga/{saga}', V1\Like\Saga\RemoveLike::class);

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
    // Audio player
    Route::get('/ticks', V1\Tick\ListTicks::class);
    Route::get('/ticks/current', V1\Tick\CurrentTick::class);
//    Route::get('/ticks/{saga}', ShowTickForSaga::class);
//    Route::group(['middleware' => 'throttle:15,1'], function () {
        Route::post('/ticks/{track}', V1\Tick\SaveTick::class);
//    });
});

Route::any('{any}', V1\NotFoundAction::class)->where('any', '.*');

//*/
