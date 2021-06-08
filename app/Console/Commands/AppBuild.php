<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build de aplicação';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->comment('⚙️  Criando/alterando models');

        // if (app()->environment('production')) {
        //     // Sincronizar tabelas
        //     return;
        // }

        $commands = [];

        $commands[] = [
            'title' => 'Migrate',
            'command' => 'migrate',
        ];

        $commands[] = [
            'title' => 'Seed',
            'command' => 'db:seed',
        ];

        $commands[] = [
            'title' => 'Limpar caches',
            'command' => 'app:clear',
        ];

        $commands[] = [
            'title' => 'Cria configurações e schemas',
            'command' => 'app:schema',
        ];

        $commands[] = [
            'title' => 'Gera/altera arquivos de model',
            'command' => 'app:make-models',
        ];

        $commands[] = [
            'title' => 'Gera/altera arquivos de controllers',
            'command' => 'app:make-controllers',
        ];

        $commands[] = [
            'title' => 'Gera/altera arquivo de rotas',
            'command' => 'app:make-routes',
        ];
        
        $commands[] = [
            'title' => 'Gera/altera arquivos de UI',
            'command' => 'app:make-ui',
        ];

        foreach($commands as $com) {
            $this->comment("⚙️  {$com['title']}");
            try {
                \Artisan::call($com['command']);
            }
            catch(\Exception $e) {
                $this->comment('Error: '. $e->getMessage());
            }
        }
    }
}
