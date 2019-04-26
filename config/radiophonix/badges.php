<?php

use Radiophonix\Domain\Badge\Badges;

return [

    /*
    |--------------------------------------------------------------------------
    | Badges
    |--------------------------------------------------------------------------
    |
    */

    'mp3-at-paris-2019' => [
        'title' => 'MP3@Paris 2019',
        'description' => "Pour avoir été en personne à l'évènement",
    ],

    'beta-test' => [
        'title' => 'Beta test',
        'description' => "Pour être une des premières personnes à s'inscrire",
        'class' => Badges\BetaTestBadge::class,
    ],

];
