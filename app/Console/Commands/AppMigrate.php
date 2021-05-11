<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronização de schema';

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
        // $this->comment('Iniciando deploy');

        $database = env('DB_DATABASE');
        $schema = $this->getSchema();
        $schema_cfg = config('database-schema');
        $sqls = [];

        foreach($schema_cfg['tables'] as $table_cfg_name => $table_cfg) {
            
            // se tabela existe no banco
            if (isset($schema['tables'][ $table_cfg_name ])) {
                
                // verificar colunas que precisam ser alteradas ou inseridas
                foreach($table_cfg['Fields'] as $field_cfg_name => $field_cfg) {
                    $field_cfg_type = $this->getFieldSchema($field_cfg);

                    // adicionar coluna
                    if (isset($schema['tables'][ $field_cfg_name ])) {
                        $sqls[] = "ALTER TABLE `{$table_cfg_name}` ADD COLUMN `{$field_cfg_name}` {$field_cfg_type};";
                    }
                    // alterar coluna
                    else {
                        if (! isset($schema['tables'][$table_cfg_name]['Fields'][$field_cfg_name])) continue;
                        $sqls[] = "ALTER TABLE `{$table_cfg_name}` CHANGE COLUMN `{$field_cfg_name}` `{$field_cfg_name}` {$field_cfg_type};";
                    }
                }

                // verificar colunas que precisam ser removidas
                $table_fields = array_keys(isset($schema['tables'][ $table_cfg_name ])? $schema['tables'][ $table_cfg_name ]['Fields']: []);
                $table_cfg_fields = array_keys($table_cfg['Fields']);
                $delete_fields = array_diff($table_fields, $table_cfg_fields);
                foreach($delete_fields as $delete_field) {
                    $sqls[] = "ALTER TABLE `{$table_cfg_name}` DROP COLUMN `{$delete_field}`;";
                }
            }

            // se não existe, criar tabela
            else {
                $sql_create = [];
                foreach($table_cfg['Fields'] as $field_cfg_name => $field_cfg) {
                    $field_cfg_type = $this->getFieldSchema($field_cfg);
                    $sql_create[] = "\t{$field_cfg_name} {$field_cfg_type}";
                }

                foreach($table_cfg['Fields'] as $field_cfg_name => $field_cfg) {
                    if ($field_cfg['Key']=='PRI') {
                        $sql_create[] = "\tPRIMARY KEY (`{$field_cfg_name}`) USING BTREE";
                        break;
                    }
                }

                // foreach($schema_cfg['fks'] as $fk_cfg_name => $fk_cfg) {
                //     if ($table_cfg_name != $fk_cfg['TABLE_NAME']) continue;
                //     $sql_create[] = "\tINDEX `{$fk_cfg['CONSTRAINT_NAME']}` (`{$fk_cfg['COLUMN_NAME']}`) USING BTREE";
                // }

                // foreach($schema_cfg['fks'] as $fk_cfg_name => $fk_cfg) {
                //     if ($table_cfg_name != $fk_cfg['TABLE_NAME']) continue;
                //     $sql_create[] = "\tCONSTRAINT `{$fk_cfg['CONSTRAINT_NAME']}` FOREIGN KEY (`{$fk_cfg['COLUMN_NAME']}`) REFERENCES `{$database}`.`{$fk_cfg['REFERENCED_TABLE_SCHEMA']}` (`{$fk_cfg['REFERENCED_COLUMN_NAME']}`) ON UPDATE RESTRICT ON DELETE RESTRICT";
                // }

                $sql_create = implode(",\n", $sql_create);
                $sql_create = "CREATE TABLE `{$table_cfg_name}` (\n{$sql_create}\n) COLLATE='{$table_cfg['Collation']}' ENGINE={$table_cfg['Engine']};";
                $sqls[] = $sql_create;
            }
        }

        // deletar tabelas
        $delete_tables = array_diff(array_keys($schema['tables']), array_keys($schema_cfg['tables']));
        foreach($delete_tables as $delete_table) {
            $sqls[] = "DROP TABLE `{$delete_table}`;";
        }

        // criando chaves estrangeiras
        // ALTER TABLE `teveps` ADD CONSTRAINT `FK_teveps_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
        foreach($schema_cfg['fks'] as $fk_cfg_name => $fk_cfg) {
            if (! isset($schema['fks'][ $fk_cfg_name ])) {
                $sqls[] = "ALTER TABLE `{$fk_cfg['TABLE_NAME']}` ADD CONSTRAINT `{$fk_cfg['CONSTRAINT_NAME']}` FOREIGN KEY (`{$fk_cfg['COLUMN_NAME']}`) REFERENCES `{$fk_cfg['REFERENCED_TABLE_NAME']}` (`{$fk_cfg['REFERENCED_COLUMN_NAME']}`);";
            }
        }

        foreach($sqls as $sql) {
            $this->comment($sql);
            \DB::select(\DB::raw($sql));
        }
    }

    public function getFieldSchema($field) {
        $schema = [ $field['Type'] ];
        $schema[] = ($field['Null']=='NO'? 'NOT NULL': 'NULL');
        if ($field['Extra']=='auto_increment') $schema[] = 'AUTO_INCREMENT';
        if ($field['Key'] != 'PRI' AND !\Str::contains($field['Type'], 'varchar') AND !\Str::contains($field['Type'], 'int')) {
            $schema[] = ($field['Default']===NULL? 'DEFAULT NULL': "DEFAULT '{$field['Default']}'");
        }
        return implode(' ', $schema);
    }

    public function getSchema() {
        $database_schema = [
            'tables' => [],
            'fks' => [],
        ];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $table->Fields = [];
            foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
                $table->Fields[ $col->Field ] = $col;
            }
            $database_schema['tables'][ $table->Name ] = $table;
        }

        $database = env('DB_DATABASE');
        foreach(\DB::select("SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME != 'PRIMARY' ") as $fk) {
            $kname = "{$fk->TABLE_NAME}-{$fk->COLUMN_NAME}-{$fk->REFERENCED_TABLE_NAME}-{$fk->REFERENCED_COLUMN_NAME}";
            $database_schema['fks'][$kname] = $fk;
        }

        return json_decode(json_encode($database_schema), true);
    }
}
