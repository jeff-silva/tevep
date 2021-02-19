<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMakeSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar migration/seed baseado na estrutura do banco de dados';

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
        $_field = function($col) {
            $field = ["\$table"];
    
            if ($col->Field=='id') {
                $field[] = 'id()';
                return implode('->', $field);
            }
    
            if ($col->Field=='created_at') {
                $field[] = 'timestamps()';
                return implode('->', $field);
            }
    
            if (preg_match('/int\((.+?)\)/', $col->Type, $match)) {
                $field[] = "integer('{$col->Field}')";
            }
            else if (preg_match('/varchar\((.+?)\)/', $col->Type, $match)) {
                $field[] = "string('{$col->Field}', {$match[1]})";
            }
            else if (preg_match('/text/', $col->Type, $match)) {
                $field[] = "text('{$col->Field}')";
            }
            else if (preg_match('/decimal\(([0-9]+?),([0-9]+?)\)/', $col->Type, $match)) {
                $field[] = "decimal('{$col->Field}', {$match[1]}, {$match[2]})";
            }
            else {
                $field[] = "text('{$col->Field}')";
            }
    
            if ($col->Null=='YES') {
                $field[] = 'nullable()';
            }
    
            return implode('->', $field);
        };
    
        $file = [
            '<?php',
            '',
            'namespace Database\Seeders;',
            '',
            'use Illuminate\Database\Seeder;',
            'use Illuminate\Support\Facades\DB;',
            'use Illuminate\Support\Facades\Hash;',
            'use Illuminate\Support\Facades\Schema;',
            '',
            '/*',
            ' * Este arquivo é gerado automaticamente, Não edite-o diretamente.',
            ' * Para gerar este arquivo execute o comando "php artisan app:make-seed".',
            ' * Este seeder é executado através do comando "php artisan app:deploy".',
            ' * Arquivo gerado pela última vez em '.date('d/m/Y à\s H:i:s'),
            '*/',
            'class AutoSeeder extends Seeder',
            '{',
            '',
            "\tpublic function run() {",
            '',
        ];
    
        $file[] = "\t\t\$schema = [";
        foreach(array_map('reset', \DB::select('SHOW TABLES')) as $table) {
            $file[] = "\t\t\t'{$table}' => [";
            foreach(\DB::select("describe {$table}") as $col) {
                if ($col->Field=='updated_at') {
                    $file[] = "\t\t\t\t'{$col->Field}' => function(\$table) { /* Gerado pela função timestamps() */ },";
                    continue;
                }
                $file[] = "\t\t\t\t'{$col->Field}' => function(\$table) { {$_field($col)}; },";
            }
            $file[] = "\t\t\t],";
        }
        $file[] = "\t\t];";
        $file[] = '';
        $file[] = "\t\tforeach(\$schema as \$table_name=>\$columns) {";
        $file[] = "\t\t\tif (\Schema::hasTable(\$table_name)) {";
        $file[] = "\t\t\t\t\Schema::table(\$table_name, function(\$table) use(\$table_name, \$columns) {";
        $file[] = "\t\t\t\t\tforeach(\$columns as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tif (\Schema::hasColumn(\$table_name, \$column)) continue;";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t}";
        $file[] = "\t\t\telse {";
        $file[] = "\t\t\t\t\Schema::create(\$table_name, function(\$table) use(\$columns) {";
        $file[] = "\t\t\t\t\tforeach(\$columns as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t}";
        $file[] = "\t\t}";
    
    
        $file[] = "\t}";
        $file[] = '}';
        $file[] = '';
        $file = implode("\n", $file);
        
        // $this->comment($file);
        $seeder_path = base_path(implode(DIRECTORY_SEPARATOR, ['database', 'seeders', 'AutoSeeder.php']));
        file_put_contents($seeder_path, $file);
    }
}
