<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy de aplicação';

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
     * @return int
     */
    public function handle()
    {
        $commands = [
            // 'migrate',
            'db:seed --class=AutoSeeder',
            'db:seed',
            'config:cache',
            'config:clear',
            'view:clear',
            'route:clear',
            'optimize:clear',
            'storage:link',
        ];
    
        foreach($commands as $com) {
            $r = \Artisan::call($com);
            $this->comment("artisan $com");
        }
        
        $this->comment('Finalizado');
    }
}
