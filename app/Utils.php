<?php

namespace App;

class Utils
{
    static function validate($data=[], $rules=[], $messages=[]) {
        $validator = \Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            throw new \Exception(json_encode([
                'error' => $validator->errors(),
            ]));
        }
        return false;
    }



    static function mail($data=[]) {
        $data = array_merge([
            'to' => '',
            'subject' => '',
            'body' => '',
        ], $data);

        return \App\Models\Email::send($data['to'], $data['subject'], $data['body']);
    }



    static function path($path) {
        return implode(DIRECTORY_SEPARATOR, preg_split('/\\\|\//', $path));
    }



    static function realpath($path) {
        return realpath(self::path($path));
    }



    static function fieldCreate($className, $field_name, $callback) {
        $table_name = (new $className)->getTable();

        if (! \Schema::hasTable($table_name)) {
            \Schema::create($table_name, function($table) {
                $table->increments('id');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
            });
        }

        if (\Schema::hasColumn($table_name, $field_name)) return;

        \Schema::table($table_name, function($table) use($callback) {
            call_user_func($callback, $table);
        });
    }
    
    

    static function fieldUpdate($className, $field_name, $callback) {
        $table_name = (new $className)->getTable();

        if (! \Schema::hasTable($table_name)) {
            \Schema::create($table_name, function($table) {
                $table->increments('id');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
            });
        }

        if (! \Schema::hasColumn($table_name, $field_name)) return;

        \Schema::table($table_name, function($table) use($callback) {
            call_user_func($callback, $table);
        });
    }


    static function dbSeed($class, $id, $callback) {
        if (! $model = (new $class)->find($id)) {
            call_user_func($callback);
        }
    }
}