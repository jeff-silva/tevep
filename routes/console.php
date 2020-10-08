<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('app-deploy', function () {
    \Artisan::call('cache:clear');
    
    $this->comment('App Deploy');
    $this->comment('');

    $models = [];
    foreach(\App\Utils::classes() as $class) {
        $artisan = $this;
        $instance = new $class;
        $classname = str_replace('\App\\', '', $class);

        $table_name = $instance->getTable();
        $table_exists = \Schema::hasTable($table_name);
        
        $artisan->comment("------ $class --------------------");
        $artisan->comment("{$table_name}". ($table_exists? ' exists': ' not exists'));

        $models[ $table_name ] = $instance;

        if (in_array('deployMigration', get_class_methods($instance))) {

            $createUpdateFields = function($columns, $table, $fields) use($artisan, $table_name) {
                foreach($columns as $column=>$args) {
                    
                    $exists = in_array($column, $fields);
                    $artisan->comment("{$table_name}.{$column}". ($exists? ' exists': ' not exists'));
                    if ($exists) continue;

                    $method = $args[0];
                    $args[0] = $column;

                    if (in_array($method, ['nullableTimestamps', 'softDeletes', 'timestamps', 'rememberToken'])) {
                        $args = [];
                    }

                    $this->comment("\$table->{$method}(". implode(', ', $args) .")->nullable();");
                    call_user_func_array([$table, $method], $args)->nullable();
                }
            };

            if ($table_exists) {
                \Schema::table($table_name, function($table) use($artisan, $createUpdateFields, $instance, $table_name) {
                    $fields = [];
                    foreach(\Schema::getColumnListing($table_name) as $field) {
                        $fields[ $field ] = $field;
                    }

                    $columns = call_user_func([$instance, 'deployMigration'], $artisan, $table, $fields);
                    $createUpdateFields($columns, $table, $fields);

                    if (!isset($fields['created_at']) OR !isset($fields['updated_at'])) { $table->timestamps(); }
                    if (!isset($fields['deleted_at'])) { $table->softDeletes(); }
                });
            }
            else {
                \Schema::create($table_name, function($table) use($artisan, $createUpdateFields, $instance) {
                    $table->id();
                    $columns = call_user_func([$instance, 'deployMigration'], $artisan, $table, []);
                    $createUpdateFields($columns, $table, []);
                    $table->timestamps();
                    $table->softDeletes();
                });
            }

            if (in_array('deploySeed', get_class_methods($instance))) {
                call_user_func([$instance, 'deploySeed'], $artisan, $table_exists);
            }

            if (in_array('deployModels', get_class_methods($instance))) {
                $models = call_user_func([$instance, 'deployModels'], $this, $models);
            }

            if ('local'==env('APP_ENV')) {
                $jsmodel = ["export default class {$classname} {", ''];
                foreach($instance->toArray() as $key=>$val) {
                    $val = json_encode($val);
                    $jsmodel[] = "\t{$key} = {$val};";
                }
                
                $jsmodel[] = "\t_loading = false;";
                $jsmodel[] = '';
                
                $jsmodel[] = "\tconstructor(attributes={}) {";
                $jsmodel[] = "\t\tattributes = Object.assign(".json_encode($instance->toArray()).", attributes);";
                $jsmodel[] = "\t\tfor(var i in attributes) { this[i] = attributes[i]; }";
                $jsmodel[] = "\t}";
                $jsmodel[] = '';
    
                if ($instance->jsMethods AND is_array($instance->jsMethods)) {
                    foreach($instance->jsMethods as $method=>$sets) {
                        if (!is_callable([$instance, $method])) continue;
                        $sets = is_array($sets)? $sets: [];
    
                        $params = [];
                        foreach((new \ReflectionMethod($instance, $method))->getParameters() as $param) {
                            $paramValue = json_encode($param->getDefaultValue());
                            $params[] = "{$param->getName()}={$paramValue}";
                        }
                        $params = implode(', ', $params);
    
                        $jsmodel[] = "\t{$method}({$params}) {";
                        $jsmodel[] = "\t\treturn new Promise((resolve, reject) => {";
                        
                        $jsmodel[] = "\t\t\tlet _delete = () => {";
                        $jsmodel[] = "\t\t\t\tthis._loading = true;";
                        $jsmodel[] = "\t\t\t\tlet post = {attributes:this, class:'{$classname}', method:'{$method}', arguments:([].slice.call(arguments))};";
                        $jsmodel[] = "\t\t\t\twindow.\$nuxt.\$axios.post('/api/call/', post).then((resp) => {";
                        $jsmodel[] = "\t\t\t\t\tthis._loading = false;";
                        $jsmodel[] = "\t\t\t\t\tresolve(resp);";
                        $jsmodel[] = "\t\t\t\t}).catch((a, b, c, d, e) => { reject(a, b, c, d, e); });";
                        $jsmodel[] = "\t\t\t};";
    
                        if (isset($sets['confirm'])) {
                            $jsmodel[] = "\t\t\twindow.\$nuxt.\$swal({title: 'Confirmação', html: `{$sets['confirm']}`, }).then((resp) => {";
                            $jsmodel[] = "\t\t\t\tif (resp.value) { _delete(); }";
                            $jsmodel[] = "\t\t\t});";
                        }
    
                        else { $jsmodel[] = "\t\t\t_delete();"; }
    
                        
                        $jsmodel[] = "\t\t});";
                        $jsmodel[] = "\t}";
                        $jsmodel[] = '';
                    }
                }
    
                $jsmodel[] = '}';
                $jsmodel = implode("\n", $jsmodel);
    
                $model_file = base_path(implode(DIRECTORY_SEPARATOR, ['resources', 'nuxt', 'models', "{$classname}.js"]));
                file_put_contents($model_file, $jsmodel);
            }
        }

        $this->comment('');
    }

    if ('local'==env('APP_ENV')) {
        $models_file = base_path(implode(DIRECTORY_SEPARATOR, ['resources', 'nuxt', 'plugins', 'models.json']));
        file_put_contents($models_file, json_encode($models));
        $this->comment('Models generated');
    }
    
    $this->comment('Finish');
})->describe('App deploy');