<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppDbSchema extends AppBase
{

    protected $signature = 'app:db-schema';
    protected $description = 'Cria um dump do schema do banco de dados';

    public function handle() {
        $files = (object) [
            'install_php' => ['<?php', ''],
            'schema_php' => ['<?php', ''],
            'schema_sql' => [],
        ];

        $files->schema_php[] = $files->install_php[] = '/* In case of foreign key error, use commands above:';
        $files->schema_php[] = $files->install_php[] = ' * SET FOREIGN_KEY_CHECKS=0;';
        $files->schema_php[] = $files->install_php[] = ' * SET GLOBAL FOREIGN_KEY_CHECKS=0;';
        $files->schema_php[] = $files->install_php[] = ' */';
        $files->schema_php[] = $files->install_php[] = '';
        $files->schema_php[] = $files->install_php[] = "\$database = env('DB_DATABASE');";

        $files->schema_sql[] = '-- In case of foreign key error, use commands above:';
        $files->schema_sql[] = '-- SET FOREIGN_KEY_CHECKS=0;';
        $files->schema_sql[] = '-- SET GLOBAL FOREIGN_KEY_CHECKS=0;';

        foreach($this->getTables() as $table) {
            $sql_create = collect( \DB::select("SHOW CREATE table {$table->Name};") )->pluck('Create Table')->first();
            $sql_create = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $sql_create);
            $sql_create = preg_replace('/AUTO_INCREMENT=[0-9]+\s/', '', $sql_create);

            $files->schema_sql[] = '';
            $files->schema_sql[] = '';
            $files->schema_sql[] = $sql_create;

            $files->schema_php[] = '';
            $files->schema_php[] = '';
            $files->schema_php[] = "// Create table {$table->Name}";
            $files->schema_php[] = "\DB::statement(\"{$sql_create}\");";

            if ($this->isBasicTable($table->Name)) {
                $files->install_php[] = '';
                $files->install_php[] = '';
                $files->install_php[] = "// Create table {$table->Name}";
                $files->install_php[] = "\DB::statement(\"{$sql_create}\");";
            }

            foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
                preg_match("/(`{$col->Field}`.+),/", $sql_create, $field_type);
                if (! isset($field_type[1])) continue;
                $field_type = $field_type[1];

                // Tables
                $files->schema_php[] = '';
                $files->schema_php[] = '';
                $files->schema_php[] = "// Create/Update column {$table->Name}.{$col->Field}";
                $files->schema_php[] = "\Schema::hasColumn('{$table->Name}', '{$col->Field}')?";
                $files->schema_php[] = "\t\DB::select(\"ALTER TABLE {$table->Name} MODIFY COLUMN {$field_type}\"):";
                $files->schema_php[] = "\t\DB::select(\"ALTER TABLE {$table->Name} ADD COLUMN {$field_type}\");";

                // Foreign keys
                // preg_match_all('/CONSTRAINT\s+`(.+?)`.+/', $sql_create, $constraints);
                // if (isset($constraints[0]) AND is_array($constraints[0])) {
                //     foreach($constraints[0] as $i => $const_sql) {
                //         $const_name = $constraints[1][$i];

                //         $files->schema_php[] = '';
                //         $files->schema_php[] = '';
                //         $files->schema_php[] = "// Create fk {$const_name}";
                //         $files->schema_php[] = "if (! collect(\DB::select(\"SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{\$database}' AND CONSTRAINT_NAME='{$const_name}'\"))->first()) {";
                //         $files->schema_php[] = "\t\DB::select(\"ALTER TABLE `{$table->Name}` ADD {$const_sql}\");";
                //         $files->schema_php[] = "}";
                //     }
                // }
            }
        }

        
        file_put_contents(database_path('install.php'), implode("\n", $files->install_php));
        $this->comment('Generated: '. database_path('install.php'));

        file_put_contents(database_path('schema.php'), implode("\n", $files->schema_php));
        $this->comment('Generated: '. database_path('schema.php'));

        file_put_contents(database_path('schema.sql'), implode("\n", $files->schema_sql));
        $this->comment('Generated: '. database_path('schema.sql'));
    }
}
