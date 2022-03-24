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
                $files->schema_php[] = "\t\DB::statement(\"ALTER TABLE {$table->Name} MODIFY COLUMN {$field_type}\"):";
                $files->schema_php[] = "\t\DB::statement(\"ALTER TABLE {$table->Name} ADD COLUMN {$field_type}\");";

            }

            // Foreign keys
            preg_match_all('/CONSTRAINT\s+`(.+?)`.+/', $sql_create, $constraints);
            if (isset($constraints[0]) AND is_array($constraints[0])) {
                foreach($constraints[0] as $i => $const_sql) {
                    $const_name = $constraints[1][$i];

                    $files->schema_php[] = '';
                    $files->schema_php[] = '';
                    $files->schema_php[] = "// Create fk {$const_name}";
                    $files->schema_php[] = "if (! collect(\DB::select(\"SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{\$database}' AND CONSTRAINT_NAME='{$const_name}'\"))->first()) {";
                    $files->schema_php[] = "\t\DB::select(\"ALTER TABLE `{$table->Name}` ADD {$const_sql}\");";
                    $files->schema_php[] = "}";
                }
            }
        }

        
        file_put_contents(database_path('install.php'), implode("\n", $files->install_php));
        file_put_contents(database_path('schema.php'), implode("\n", $files->schema_php));
        file_put_contents(database_path('schema.sql'), implode("\n", $files->schema_sql));
        $this->makeSvg();
    }


    public function makeSvg() {
        $tables = $this->getTables();

        $svg = (object) [
            'table_width' => 200,
            'table_space' => 15,
            'tables_per_line' => 5,
            'tables' => [],
        ];

        $table_width = 200;
        $table_space = 15;
        $tables_per_line = 5;
        $svg_width = ($svg->tables_per_line * $svg->table_width) + ($svg->tables_per_line * $svg->table_space) - $svg->table_space;

        $svg_content = [];

        $table_x = 0;
        $table_y = 0;
        $tables_heights = [];
        foreach($tables as $table) {
            if ($this->isIgnoredTable($table->Name)) continue;
            
            $table_lines = 1 + sizeof($table->Fields);
            $field_height = 20;
            $table_height = $table_lines * $field_height;

            $svg_content[] = '';
            $svg_content[] = "  <svg x='{$table_x}' y='{$table_y}' width='{$svg->table_width}' height='{$table_height}'>";
            $svg_content[] = "      <rect width='100%' height='100%' style='fill:#f5f5f5; stroke:#ddd; stroke-width:1;' />";
            $svg_content[] = "      <rect width='100%' height='{$field_height}' style='fill:#ddd;' />";
            $svg_content[] = "      <text x='5' y='5' width='100%' style='alignment-baseline:hanging; font-family:monospace; font-weight:bold;'>{$table->Name}</text>";
            
            $field_y = $field_height;
            foreach($table->Fields as $field) {
                // $svg_content[] = "      <rect x='0' y='{$field_y}' width='100%' height='{$field_height}' style='fill:none; stroke:#444; stroke-width:1;' />";
                $svg_content[] = "      <text x='5' y='".($field_y+5)."' width='100%' style='alignment-baseline:hanging; font-family:monospace;'>{$field->Field}</text>";
                $field_y += $field_height;
            }

            $svg_content[] = "  </svg>";

            $tables_heights[] = $table_height;
            $table_x += ($table_width + $table_space);
            if ($table_x >= (($tables_per_line * $table_width) + 1)) {
                $table_x = 0;
                $table_y += ($table_height + ($table_space*4));
                $tables_heights = [];
            }
        }

        $svg_content[] = '</svg>';

        $svg_height = $table_y + max($tables_heights);

        $svg_content = implode("\n", $svg_content);
        $svg_content = implode("\n", [
            '<?xml version="1.0" encoding="UTF-8"?>',
            "<svg width='{$svg_width}px' height='{$svg_height}px' xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\">",
            $svg_content,
        ]);

        
        file_put_contents(database_path('schema.svg'), $svg_content);
    }
}
