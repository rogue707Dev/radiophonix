<?php

namespace Radiophonix\Console\Commands;

use Illuminate\Console\Command;

class ProcessTickMetrics extends Command
{
    /** @var string */
    protected $signature = 'metrics:process {type}';

    /** @var string */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        // récupérer toutes les lignes de la table `metrics` du jour précédent selon l'argument {type}
        // pagination ?
        // récupérer une classe responsable du type et l'exécuter avec les lignes données

        // Pour le type `tick`
        // définir ce qui constitue "1 écoute" et l'ajouter aux stats de la saga
        // - en fonction du pourcentage total écouté par un même utilisateur
        // calculer la somme des secondes pour l'ajouter aux stats de la saga
    }
}
