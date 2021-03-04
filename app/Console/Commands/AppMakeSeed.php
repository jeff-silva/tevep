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
        $_field = function($col, $last=false) {
            $field = ['$table'];
    
            if ($col->Field=='id') {
                $field[] = 'id()';
            }
    
            else if ($col->Field=='created_at') {
                $field[] = 'nullableTimestamps()';
            }

            else if ($col->Field=='updated_at') {
                return '/* Gerado pela função nullableTimestamps() dentro de created_at */';
            }

            else {
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
                else if (preg_match('/enum\((.+?)\)/', $col->Type, $match)) {
                    $field[] = "enum('{$col->Field}', [{$match[1]}])";
                }
                else {
                    $field[] = "text('{$col->Field}')";
                }
            }

            // if ($last) {
            //     $field[] = "after('{$last->Field}')";
            // }

            if ($col->Default) {
                $field[] = "default('{$col->Default}')";
            }
            
            if ($col->Comment) {
                $col->Comment = addslashes($col->Comment);
                $field[] = "comment('{$col->Comment}')";
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
            ' * O banco de dados contido aqui é criado ao executar o comando "php artisan app:deploy".',
            ' * Arquivo gerado pela última vez em '.date('d/m/Y à\s H:i:s'),
            '*/',
            '',
            'class AutoSeeder extends Seeder',
            '{',
            '',
            "\tpublic function run() {",
            '',
        ];
    
        $file[] = "\t\t\$schema = [";

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            if ($table->Comment) {
                $table->Comment = addslashes($table->Comment);
                $file[] = "\t\t\t/* {$table->Comment} */";
            }

            $file[] = "\t\t\t'{$table->Name}' => [";
            $file[] = "\t\t\t\t'comment' => '{$table->Comment}',";
            $file[] = "\t\t\t\t'fields' => [";
            
            $last = false;
            foreach(\DB::select("SHOW FULL COLUMNS FROM {$table->Name}") as $col) {
                if ($col->Comment) {
                    $file[] = "\t\t\t\t\t/* {$col->Field}: {$col->Comment} */";
                }
                $file[] = "\t\t\t\t\t'{$col->Field}' => function(\$table) { {$_field($col, $last)}; },";
                $last = $col;
            }
            $file[] = "\t\t\t\t],";

            $file[] = "\t\t\t],";
        }

        $file[] = "\t\t];";
        $file[] = '';
        $file[] = "\t\tforeach(\$schema as \$table_name=>\$table_data) {";
        $file[] = "\t\t\tif (\Schema::hasTable(\$table_name)) {";
        $file[] = "\t\t\t\t\Schema::table(\$table_name, function(\$table) use(\$table_name, \$table_data) {";
        $file[] = "\t\t\t\t\tforeach(\$table_data['fields'] as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tif (\Schema::hasColumn(\$table_name, \$column)) continue;";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t\t\DB::statement(\"ALTER TABLE `\$table_name` comment '{\$table_data['comment']}'\");";
        $file[] = "\t\t\t}";
        $file[] = "\t\t\telse {";
        $file[] = "\t\t\t\t\Schema::create(\$table_name, function(\$table) use(\$table_name, \$table_data) {";
        $file[] = "\t\t\t\t\tforeach(\$table_data['fields'] as \$column=>\$callback) {";
        $file[] = "\t\t\t\t\t\tcall_user_func(\$callback, \$table);";
        $file[] = "\t\t\t\t\t}";
        $file[] = "\t\t\t\t});";
        $file[] = "\t\t\t\t\DB::statement(\"ALTER TABLE `\$table_name` comment '{\$table_data['comment']}'\");";
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
