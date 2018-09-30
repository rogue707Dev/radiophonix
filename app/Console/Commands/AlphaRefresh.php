<?php

namespace Radiophonix\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\ConsoleOutput;

class AlphaRefresh extends Command
{
    /**
     * @var string
     */
    protected $signature = 'alpha:refresh';

    /**
     * @var string
     */
    protected $description = 'Refresh des données de l\'alpha';

    public function handle()
    {
        $this->alert('Refresh de la BDD');
        Artisan::call('migrate:fresh', [], new ConsoleOutput());

        $this->line('');
        $this->alert('Nettoyage des anciennes images');
        Artisan::call('medialibrary:clean', [], new ConsoleOutput());
        Artisan::call('medialibrary:clear', [], new ConsoleOutput());

        $this->line('');
        $this->alert('Seed des données de l\'alpha');
        Artisan::call('alpha:seed', [], new ConsoleOutput());

        $this->line('');
        $this->alert('Refresh des index de recherche');
        Artisan::call('scout:mysql-index', [], new ConsoleOutput());
    }
}
