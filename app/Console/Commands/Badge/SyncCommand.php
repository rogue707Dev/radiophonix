<?php

namespace Radiophonix\Console\Commands\Badge;

use Illuminate\Console\Command;
use Radiophonix\Badge\BadgeRegistry;
use Radiophonix\Badge\BadgeType;
use Radiophonix\Models\Badge;

class SyncCommand extends Command
{
    /** @var string */
    protected $signature = 'badge:sync';

    /** @var string */
    protected $description = 'Synchronise les badges en base';

    /** @var BadgeRegistry */
    private $registry;

    public function __construct(BadgeRegistry $registry)
    {
        parent::__construct();

        $this->registry = $registry;
    }

    public function handle(): int
    {
        $this->info('Synchronisation des badges en base...');

        $badgeTypes = $this->registry->all();

        // Récupération de tous les badges déjà présents en base
        $models = Badge::all()
            ->keyBy(function (Badge $badge) {
                return $badge->key;
            });

        $result = $badgeTypes
            ->map(function (BadgeType $badgeType) use ($models) {
                $model = $models->get($badgeType->key());
                $status = 'updated';

                // Création du model s'il n'existe pas encore
                if (null === $model) {
                    $model = new Badge();
                    $model->key = $badgeType->key();
                    $status = 'created';
                }

                $model->title = $badgeType->title();
                $model->description = $badgeType->description();

                $model->save();

                return [$badgeType->key(), $status];
            });

        $this->table(
            ['Key', 'Status'],
            $result->all()
        );

        return 0;
    }
}
