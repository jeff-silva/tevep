<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppSyncModelFields extends AppBase
{

    protected $signature = 'app:sync-model-fields';
    protected $description = 'Synchronize database by models data';

    public function handle() {
        foreach($this->getModels() as $model) {
            $table = $this->getTable($model->table);
            $table_fields = array_values(\Arr::sort(array_keys($table->Fields)));
            $model_fields = array_values(\Arr::sort(array_keys($model->fields)));
            if ($table_fields != $model_fields) {
                \Schema::table($table->Name, function($tab) use($table, $model, $table_fields, $model_fields) {
                    $delete_fields = array_diff($table_fields, $model_fields);
                    $create_fields = array_diff($model_fields, $table_fields);

                    $tab->dropColumn($delete_fields);

                    foreach($create_fields as $create_field) {
                        $statement = $model->fields[ $create_field ];
                        $statement = "ALTER TABLE {$table->Name} ADD {$create_field} {$statement}";
                        \DB::statement($statement);
                    }
                });
                
                $model_field_last = false;
                foreach($model->fields as $model_field => $model_field_type) {
                    if ($model_field_last) {
                        $statement = "ALTER TABLE {$table->Name} CHANGE COLUMN `{$model_field}` `{$model_field}` {$model_field_type} AFTER `{$model_field_last}`;";
                        \DB::statement($statement);
                    }
                    $model_field_last = $model_field;
                }

                $file = \Nette\PhpGenerator\PhpFile::fromCode(file_get_contents(base_path($model->model->File)), true);
                foreach($file->getClasses() as $file_class_name => $class) {
                    $protected_fillable = $class->getProperty('fillable');
                    $protected_fillable->setProtected();
                    $protected_fillable->setValue((array) array_keys($model->fields));
                    file_put_contents(base_path($table->Model->File), $file->__toString());
                }

                $this->info('Database Sync Model Fields');
            }

        }
    }
}
