<?php

namespace App\Console\Commands;

class AppBase extends \Illuminate\Console\Command
{

    protected $signature = 'app:test';
    protected $description = 'App test';

    public $tables = false;
    public $fks = false;

    public function handle() {
        $this->comment('Hello World');
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

        $return = (object) ['Name' => ((string) \Str::of($params->name)->slug()->studly()) .$params->suffix ];
        $return->Namespace = $params->namespace;
        $return->NameFull = "{$params->namespace}\\{$return->Name}";
        $return->File = "\\{$params->path}\\{$return->Name}.php";
        $return->FileExists = file_exists(base_path($return->File));
        $return->Slug = (string) \Str::of($params->name)->studly()->kebab();

        return $return;
    }

    public function getModel($table_name)
    {
        return $this->classInfo([
            'name' => $table_name,
            'namespace' => 'App\Models',
            'path' => 'app\Models',
        ]);
    }

    public function getController($table_name)
    {
        return $this->classInfo([
            'name' => $table_name,
            'namespace' => 'App\Http\Controllers',
            'path' => 'app\Http\Controllers',
            'suffix' => 'Controller',
        ]);
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

    public function getModels()
    {
        $models = [];

        foreach(\App\Utils::getModels() as $model) {
            $fields = $model->getSchemaFields();
            if (empty($fields)) continue;

            $table_name = $model->getTable();

            $models[ $table_name ] = (object) [
                'singular' => $model->getSingular(),
                'plural' => $model->getPlural(),
                'slug' => (string) \Str::of($table_name)->studly()->kebab(),
                'table' => $table_name,
                'fields' => $fields,
                'fks' => $model->getSchemaForeignKeys(),
                'model' => $this->getModel($table_name),
                'controller' => $this->getController($table_name),
            ];
        }
        
        return collect($models);
    }

    public function getTables() {
        if ($this->tables) {
            return $this->tables;
        }

        $database = env('DB_DATABASE');
        $tables = [];

        foreach(\DB::select('SHOW TABLE STATUS') as $table) {
            $tables[ $table->Name ] = $this->getTable($table->Name);
        }        

        return $tables;
    }

    public function getTable($name) {
        $table = new \stdClass;
        $table->Slug = (string) \Str::of($name)->studly()->kebab();
        $table->Name = $name;

        $table->Model = $this->getModel($table->Name);
        $table->Controller = $this->getController($table->Name);

        $statement = collect(\DB::select("SHOW CREATE TABLE `{$table->Name}`;"))->pluck('Create Table')->first();
        $statement = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $statement);
        $table->Sql = str_replace(["\n", "\t"], '', $statement);

        $table->Fields = [];
        foreach(\DB::select("SHOW COLUMNS FROM {$table->Name}") as $col) {
            $col->Sql = $this->getFieldSchema($col);
            $table->Fields[ $col->Field ] = $col;
        }
        
        return $table;
    }

    public function getFks() {
        if ($this->fks) {
            return $this->fks;
        }

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
            return trim($file, '\\');
        }, $files);
    }
}
