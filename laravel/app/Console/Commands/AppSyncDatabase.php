<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppSyncDatabase extends AppBase
{

    protected $signature = 'app:sync-database';
    protected $description = 'Synchronize database by models data';

    public function handle() {
        foreach($this->getModels() as $model) {
            $table = $this->getTable($model['table']);
            $table_fields = \Arr::sort(array_keys($table->Fields));
            $model_fields = \Arr::sort(array_keys($model['fields']));
            if ($table_fields != $model_fields) {
                \Schema::table($table->Name, function($tab) use($table, $model, $table_fields, $model_fields) {
                    $delete_fields = array_diff($table_fields, $model_fields);
                    $create_fields = array_diff($model_fields, $table_fields);

                    $tab->dropColumn($delete_fields);

                    foreach($create_fields as $create_field) {
                        $statement = $model['fields'][ $create_field ];
                        $statement = "ALTER TABLE {$table->Name} ADD {$create_field} {$statement}";
                        \DB::statement($statement);
                    }
                });
            }
        }
        $this->info('Concluído aaaaa');
    }
}
