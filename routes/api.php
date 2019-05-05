<?php

use Radiophonix\Http\Controllers\Api\V1;

Route::post('/search', V1\Search\SearchAllController::class);

// @todo ajouter un throttle
Route::post('/feedback', V1\Feedback\SaveFeedbackController::class);

Route::get('/sagas', V1\Saga\ListSagasController::class);

//Route::group(['middleware' => 'saga.visible'], function () {
    Route::get('/sagas/{saga}', V1\Saga\ShowSagaController::class);
    Route::get('/sagas/{saga}/collections', V1\Saga\ListSagaCollectionsController::class);

    Route::get('/collections/{collection}', V1\Collection\ShowCollectionController::class);
    Route::get('/collections/{collection}/tracks', V1\Collection\ListCollectionTracksController::class);

    Route::get('/tracks/{track}', V1\Track\ShowTrackController::class);
//});

Route::get('/genres', V1\Genre\ListGenresController::class);
Route::get('/genres/{genre}', V1\Genre\ShowGenreController::class);

Route::get('/authors', V1\Author\ListAuthorsController::class);
Route::get('/authors/{author}', V1\Author\ShowAuthorController::class);
Route::get('/authors/{author}/sagas', V1\Author\ListAuthorSagasController::class);

Route::get('/teams', V1\Team\ListTeamsController::class);
Route::get('/teams/{team}', V1\Team\ShowTeamController::class);
Route::get('/teams/{team}/sagas', V1\Team\ListTeamSagasController::class);

// Profiles

Route::get('/profile/{user}', V1\User\ShowProfileController::class);
Route::get('/profile/{user}/likes', V1\User\ShowProfileLikesController::class);

// Authentification
Route::post('/auth/register', V1\Auth\RegisterUserController::class);
Route::post('/auth/login', V1\Auth\LoginUserController::class)->name('login');
Route::get('/auth/refresh', V1\Auth\RefreshTokenController::class);

// Password reset
Route::post('/auth/password/email', V1\Auth\ForgotPasswordController::class);
Route::post('/auth/password/reset', V1\Auth\ResetPasswordController::class);

// Invitations
Route::get('/invites/site/{code}', V1\Invite\Site\GetSiteInviteController::class);

///*
Route::group(['middleware' => ['jwt.auth']], function () {

    Route::patch('/settings/profile', V1\User\Profile\UpdateProfileController::class);
    Route::patch('/settings/password', V1\User\Profile\UpdatePasswordController::class);

    Route::delete('/account', V1\User\DeleteAccountController::class);

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
    Route::get('/likes', V1\Like\ListUserLikesController::class);
    Route::post('/likes/saga/{saga}', V1\Like\Saga\AddLikeController::class);
    Route::delete('/likes/saga/{saga}', V1\Like\Saga\RemoveLikeController::class);

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
    Route::get('/ticks', V1\Tick\ListTicksController::class);
    Route::get('/ticks/current', V1\Tick\CurrentTickController::class);
//    Route::get('/ticks/{saga}', ShowTickForSaga::class);
//    Route::group(['middleware' => 'throttle:15,1'], function () {
        Route::post('/ticks/{track}', V1\Tick\SaveTickController::class);
//    });
});

Route::any('{any}', V1\NotFoundController::class)->where('any', '.*');

//*/
