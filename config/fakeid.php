<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FakeId Connections
    |--------------------------------------------------------------------------
    |
    */

    'connections' => [

        'sagas' => [
            'prime' => env('FAKEID_SAGA_PRIME', 1366053443),
            'inverse' => env('FAKEID_SAGA_INVERSE', 1757481579),
            'xor' => env('FAKEID_SAGA_XOR', 781211414),
        ],

        'collections' => [
            'prime' => env('FAKEID_COLLECTION_PRIME', 1366053443),
            'inverse' => env('FAKEID_COLLECTION_INVERSE', 1757481579),
            'xor' => env('FAKEID_COLLECTION_XOR', 781211414),
        ],

        'tracks' => [
            'prime' => env('FAKEID_TRACK_PRIME', 1366053443),
            'inverse' => env('FAKEID_TRACK_INVERSE', 1757481579),
            'xor' => env('FAKEID_TRACK_XOR', 781211414),
        ],

        'users' => [
            'prime' => env('FAKEID_USER_PRIME', 1366053443),
            'inverse' => env('FAKEID_USER_INVERSE', 1757481579),
            'xor' => env('FAKEID_USER_XOR', 781211414),
        ],

        'teams' => [
            'prime' => env('FAKEID_TEAM_PRIME', 1366053443),
            'inverse' => env('FAKEID_TEAM_INVERSE', 1757481579),
            'xor' => env('FAKEID_TEAM_XOR', 781211414),
        ],

        'authors' => [
            'prime' => env('FAKEID_AUTHOR_PRIME', 1366053443),
            'inverse' => env('FAKEID_AUTHOR_INVERSE', 1757481579),
            'xor' => env('FAKEID_AUTHOR_XOR', 781211414),
        ],

        'genres' => [
            'prime' => env('FAKEID_GENRE_PRIME', 1366053443),
            'inverse' => env('FAKEID_GENRE_INVERSE', 1757481579),
            'xor' => env('FAKEID_GENRE_XOR', 781211414),
        ],

        'media' => [
            'prime' => env('FAKEID_MEDIA_PRIME', 152740249),
            'inverse' => env('FAKEID_MEDIA_INVERSE', 381493929),
            'xor' => env('FAKEID_MEDIA_XOR', 1158087893),
        ],

    ],

];
