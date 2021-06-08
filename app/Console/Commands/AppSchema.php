<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria schema do banco de dados';

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
        $this->comment('⚙️  Gerando config/database-schema.php');

        $database_schema = $this->getSchema();

        $_procedure = function($query) {
            $procedureName = '_temporary';
            return implode("\n", [
                "DROP PROCEDURE IF EXISTS `{$procedureName}`; DELIMITER //",
                "CREATE PROCEDURE `{$procedureName}`() BEGIN",
                "\tDECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;",
                "\t{$query};",
                "END // DELIMITER ; CALL {$procedureName}();",
                "DROP PROCEDURE IF EXISTS `{$procedureName}`;",
            ]);
        };

        $sqls = ['SET FOREIGN_KEY_CHECKS = 0;', ''];
        
        foreach($database_schema['tables'] as $table_name=>$table) {
            $sqls[] = "-- create table {$table_name} ";
            $sql = collect(\DB::select("SHOW CREATE TABLE `{$table_name}`;"))->pluck('Create Table')->first();
            $sql = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $sql) .';';
            $sql = preg_replace('/AUTO_INCREMENT=\d+\s/', '', $sql);
            $sqls[] = $sql;
            $sqls[] = '';
        }

        foreach($database_schema['tables'] as $table_name=>$table) {
            foreach($table['Fields'] as $col_field=>$col) {
                $fieldSchema = $this->getFieldSchema((array) $col);
                $sqls[] = "-- create field '{$col_field}' if not exists";
                $sqls[] = $_procedure("ALTER TABLE `{$table_name}` ADD COLUMN `{$col_field}` {$fieldSchema};");
                $sqls[] = '';
                
                $sqls[] = "-- modify field {$col_field} ";
                $sqls[] = "ALTER TABLE `{$table_name}` MODIFY COLUMN `{$col_field}` {$fieldSchema};";
                $sqls[] = '';
            }
        }

        foreach($database_schema['fks'] as $fk_name=>$fk) {
            $sqls[] = "-- creating fk if not exists";
            $sqls[] = $_procedure("ALTER TABLE {$fk['TABLE_NAME']} ADD CONSTRAINT {$fk_name} FOREIGN KEY ({$fk['COLUMN_NAME']}) REFERENCES {$fk['REFERENCED_TABLE_NAME']}({$fk['REFERENCED_COLUMN_NAME']});");
            $sqls[] = '';
            dump($fk_name);
        }
        
        $sqls[] = 'SET FOREIGN_KEY_CHECKS = 1;';
        file_put_contents(database_path('schema.sql'), implode("\n", $sqls));



        $content = $this->varExport($database_schema);
        $generated = "/*\n * Gerado em ". date('d/m/Y à\s H:i:s') ."\n * Por favor, não altere manualmente.\n */";
        file_put_contents(config_path('database-schema.php'), "<?php \n\n{$generated}\n\nreturn {$content};");


        $this->comment('⚙️  Gerando config/database-settings.php');
        $this->comment('Não se esqueça de alterar as configurações "model" para definir quais tabelas gerarão arquivos.');
        $database_settings_default = [
            'models' => [],
            'controllers' => [],
        ];

        $database_settings = $database_settings_default;
        foreach($database_schema['tables'] as $table_name=>$table) {
            $database_settings['models'][ $table_name ] = false;
            $database_settings['controllers'][ $table_name ] = false;
        }

        $database_settings2 = config('database-settings', $database_settings_default);
        foreach($database_settings as $name=>$value) {
            $database_settings2[$name] = isset($database_settings2[$name])? $database_settings2[$name]: [];
            $database_settings2[$name] = array_merge($database_settings[$name], $database_settings2[$name]);
        }

        file_put_contents(config_path('database-settings.php'), '<?php return '. $this->varExport($database_settings2) .';');
    }

    public function varExport($data) {
        $dump = var_export($data, true);
        $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump); // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump); // Empties
        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        }
        else {  $dump = preg_replace('#\)$#', "]", $dump); }
        return $dump;
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
            $database_schema['fks'][ $fk->CONSTRAINT_NAME ] = $fk;
        }

        return json_decode(json_encode($database_schema), true);
    }

    public function getFieldSchema($field) {
        $schema = [ $field['Type'] ];
        $schema[] = (($field['Null']=='NO' || $field['Key']=='PRI')? 'NOT NULL': 'NULL');
        if ($field['Extra']=='auto_increment') $schema[] = 'AUTO_INCREMENT';
        if ($field['Key'] != 'PRI' AND !\Str::contains($field['Type'], 'varchar') AND !\Str::contains($field['Type'], 'int') AND $field['Type']!='longtext' AND $field['Type']!='timestamp') {
            $schema[] = ($field['Default']===NULL? 'DEFAULT NULL': "DEFAULT '{$field['Default']}'");
        }
        return implode(' ', $schema);
    }
}
