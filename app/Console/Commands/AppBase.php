<?php

namespace App\Console\Commands;

class AppBase extends \Illuminate\Console\Command
{

    protected $signature = 'app:test';
    protected $description = 'App test';

    public function handle() {
        $this->comment('Hello');
    }

    public function isIgnoredTable($name)
    {
        return in_array($name, ['failed_jobs', 'migrations', 'password_resets', 'personal_access_tokens']);
    }

    public function isBasicTable($name)
    {
        return in_array($name, ['emails_templates', 'files', 'pages', 'settings', 'users', 'users_groups']);
    }

    public function tableSlug($table_name)
    {
        return (string) \Str::of($table_name)->studly()->kebab();
    }

    public function classInfo($params=[]) {
        $params = (object) array_merge([
            'name' => '',
            'namespace' => '',
            'path' => '',
            'suffix' => '',
        ], $params);

        if ($params->name=='users') { $params->name = 'user'; }

        $return = (object) ['Name' => ((string) \Str::of($params->name)->slug()->studly()) .$params->suffix ];
        $return->Namespace = $params->namespace;
        $return->NameFull = "{$params->namespace}\\{$return->Name}";
        $return->File = "\\{$params->path}\\{$return->Name}.php";
        $return->FileExists = file_exists(base_path($return->File));

        return $return;
    }

    public function getFieldSchema($field) {
        $field = (array) $field;
        $schema = [ $field['Type'] ];
        $schema[] = (($field['Null']=='NO' || $field['Key']=='PRI')? 'NOT NULL': 'NULL');
        if ($field['Extra']=='auto_increment') $schema[] = 'AUTO_INCREMENT';
        if ($field['Key'] != 'PRI' AND !str_contains($field['Type'], 'varchar') AND !str_contains($field['Type'], 'int') AND $field['Type']!='longtext' AND $field['Type']!='timestamp') {
            $schema[] = ($field['Default']===NULL? 'DEFAULT NULL': "DEFAULT '{$field['Default']}'");
        }
        return implode(' ', $schema);
    }

    public function getTables() {
        $database = env('DB_DATABASE');
        $tables = [];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $table->Slug = (string) \Str::of($table->Name)->studly()->kebab();
            // $table->Slug = $table->Slug=='users'? 'user': $table->Slug;

            $deletes = [
                'Version', 'Row_format', 'Rows', 'Avg_row_length', 'Data_length', 'Max_data_length', 'Index_length',
                'Data_free', 'Create_time', 'Update_time', 'Check_time', 'Checksum', 'Create_options',
            ];
            foreach($deletes as $delete) { unset($table->$delete); }

            $table->Model = $this->classInfo([
                'name' => $table->Name,
                'namespace' => 'App\Models',
                'path' => 'app\Models',
            ]);

            $table->Controller = $this->classInfo([
                'name' => $table->Name,
                'namespace' => 'App\Http\Controllers',
                'path' => 'app\Http\Controllers',
                'suffix' => 'Controller',
            ]);
            

            $statement = collect(\DB::select("SHOW CREATE TABLE `{$table->Name}`;"))->pluck('Create Table')->first();
            $statement = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $statement);
            $table->Sql = str_replace(["\n", "\t"], '', $statement);
            
            $table->Fields = [];
            foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
                $col->Sql = $this->getFieldSchema($col);
                $table->Fields[ $col->Field ] = $col;
            }

            $tables[ $table->Name ] = $table;
        }        

        return $tables;
    }

    public function getFks() {
        $database = env('DB_DATABASE');
        $fks = [];

        foreach(\DB::select("SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME != 'PRIMARY' AND REFERENCED_TABLE_NAME IS NOT NULL ") as $fk) {
            $fks[ $fk->CONSTRAINT_NAME ] = $fk;
        }

        return $fks;
    }

    public function varExport($data)
    {
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

    
    public function getFolderClasses($folder, $deep=false)
    {
        $files = glob(realpath(base_path($folder)) .'/*.php');

        if ($deep) {
            $files = array_merge($files, glob(realpath(base_path($folder)) .'/**/*.php'));
        }

        return array_map(function($file) {
            $file = str_replace(base_path('app'), '\App', $file);
            $file = str_replace('/', '\\', $file);
            $file = str_replace('.php', '', $file);
            $file = trim($file, '\\');
            return app($file);
        }, $files);
    }
}
