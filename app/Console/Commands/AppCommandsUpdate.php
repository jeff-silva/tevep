<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppCommandsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:commands-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza comandos';

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
        $files = [
            'AppBuild.php',
            'AppClear.php',
            'AppCommandsUpdate.php',
            'AppDeploy.php',
            'AppMakeControllers.php',
            'AppMakeModels.php',
            'AppMakeRoutes.php',
            'AppMakeUi.php',
            'AppMigrate.php',
            'AppSchema.php',
        ];

        foreach($files as $file) {
            $filepath = implode(DIRECTORY_SEPARATOR, [__DIR__, $file]);
            
            $content = "https://gist.githubusercontent.com/jeff-silva/f8eeb7f7dab044fe842a2c3402dbd486/raw/{$file}";
            $content = \Illuminate\Support\Facades\Http::get($content)->body();

            file_put_contents($filepath, $content);
            $this->comment("Atualizando {$file} - {$filepath}");
        }
    }
}
