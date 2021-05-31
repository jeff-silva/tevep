<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar/alterar rotas de acordo com métodos de controllers';

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

        $content = ['<?php', '', '// File generated automatically', '// Do not edit or your changes will be lost', ''];
        $paths = [app_path(implode(DIRECTORY_SEPARATOR, ['Http', 'Controllers']))];

        foreach((new \Symfony\Component\Finder\Finder)->in($paths)->files() as $file) {
            $filename = str_replace('.php', '', $file->getFilename());
            $namespace = "\App\Http\Controllers\\{$filename}";
            $prefix = (string) \Str::of(str_replace('Controller', '', $filename))->kebab();
            
            foreach ((new \ReflectionClass($namespace))->getMethods() as $rmethod) {
                $method_name = $rmethod->getName();
                
                $ignore = [
                    'getValidationFactory',
                    'getMiddleware',
                ];

                if (in_array($method_name, $ignore)) continue;

                $route = [$prefix];

                foreach(['any', 'get', 'post', 'put'] as $method) {
                    if (! \Str::startsWith($method_name, $method)) continue;

                    $route[] = (string) \Str::of(str_replace($method, '', $method_name))->studly()->kebab();

                    foreach($rmethod->getParameters() as $param) {
                        if (in_array($param->name, ['request'])) continue;
                        $route[] = '{'. $param->name .'}';
                    }

                    $route = implode('/', $route);
                    $content[] = "Route::{$method}('{$route}', '{$namespace}@{$method_name}');";
                }
            }
            $content[] = '';
        }

        $content = implode("\n", $content);
        $file = base_path(implode(DIRECTORY_SEPARATOR, ['routes', 'api-generated.php']));
        file_put_contents($file, $content);
    }
}


// Route::get('email-sent/search', '\App\Http\Controllers\EmailSentController@getSearch');