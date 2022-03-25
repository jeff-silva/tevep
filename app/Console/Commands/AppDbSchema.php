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

        $_arrayToSvg = function($tags) use(&$_arrayToSvg) {
            $content = [];
            foreach($tags as $tag) {
                if (!isset($tag['tag'])) continue;
                $tag['attrs'] = isset($tag['attrs'])? $tag['attrs']: [];
                $tag['attrs'] = is_array($tag['attrs'])? $tag['attrs']: [];

                $tag['inner'] = isset($tag['inner'])? $tag['inner']: '';
                
                $content[] = "<{$tag['tag']}";
                foreach($tag['attrs'] as $name => $value) {
                    $content[] = " {$name}=\"{$value}\"";
                }
                $content[] = '>';
                $content[] = (is_array($tag['inner'])? $_arrayToSvg($tag['inner']): $tag['inner']);
                $content[] = "</{$tag['tag']}>";
            }

            return implode('', $content);
        };

        $all_tables = $this->getTables();
        $tables_per_line = 4;
        $table_width = 180;
        $table_space = 20;
        $table_field_height = 25;
        $table_lines = array_values(array_chunk($all_tables, $tables_per_line));
        $svg_width = ($table_width * $tables_per_line) + ($table_space * ($tables_per_line - 1));
        $svg_height = 0;

        $svg = [];

        $table_y = 0;
        foreach($table_lines as $i => $tables) {

            if (isset($table_lines[ $i-1 ])) {
                $table_y = array_map(function($table) { return sizeof($table->Fields); }, $table_lines[ $i-1 ]);
                $table_y = $table_space + $table_field_height * (1+ max($table_y));
            }

            foreach($tables as $ii => $table) {
                $table_height = $table_field_height * (1 + sizeof($table->Fields));

                $svg_table = [
                    'tag' => 'svg',
                    'attrs' => [
                        'x' => ($ii * ($table_width + $table_space)),
                        'y' => $table_y,
                        'width' => "{$table_width}px",
                        'height' => "{$table_height}px",
                    ],
                    'inner' => [],
                ];

                $svg_table['inner'][] = [
                    'tag' => 'rect',
                    'attrs' => [
                        'width' => '100%',
                        'height' => '100%',
                        'style' => 'fill:#eeeeee;',
                    ],
                ];

                $svg_table['inner'][] = [
                    'tag' => 'rect',
                    'attrs' => [
                        'x' => 0,
                        'y' => 0,
                        'width' => '100%',
                        'height' => $table_field_height,
                        'style' => 'fill:#dddddd;',
                    ],
                ];

                $svg_table['inner'][] = [
                    'tag' => 'text',
                    'inner' => $table->Name,
                    'attrs' => [
                        'x' => 5,
                        'y' => ($table_field_height / 2),
                        'style' => 'alignment-baseline:middle; font-family:monospace; font-weight:bold; text-transform:uppercase;',
                    ],
                ];

                foreach(array_values($table->Fields) as $iii => $field) {
                    $svg_table['inner'][] = [
                        'tag' => 'text',
                        'inner' => $field->Field,
                        'attrs' => [
                            'x' => 5,
                            'y' => ($table_field_height + ($iii * $table_field_height) + ($table_field_height/2)),
                            'style' => 'alignment-baseline:middle; font-family:monospace; font-weight:bold;',
                        ],
                    ];
                }

                $svg[] = $svg_table;
            }
        }

        $svg_height = array_map(function($table) { return sizeof($table->Fields); }, $tables);
        $svg_height = $table_y + $table_field_height * (1+ max($svg_height));

        $svg_content = implode("\n", [
            '<?xml version="1.0" encoding="UTF-8"?>',
            "<svg width='{$svg_width}px' height='{$svg_height}px' xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\">",
            $_arrayToSvg($svg), '</svg>',
        ]);
        file_put_contents(database_path('schema.svg'), $svg_content);
    }
}
