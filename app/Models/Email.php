<?php

namespace App\Models;

class Email extends \Illuminate\Database\Eloquent\Model
{
    use \App\Traits\Model;

    protected $fillable = [
        'id',
        'name',
        'subject',
        'body',
        'params',
        'updated_at',
        'created_at',
    ];

    public function getParamsAttribute($value) {
        return is_array($value)? $value: json_decode($value, true);
    }


    public function deploy() {
        foreach(glob(app_path('Mail') .'/*.php') as $file) {
            $info = (object) array_merge(['file'=>$file], pathinfo($file));
            $info->namespace = "\App\Mail";
            $info->class = "{$info->namespace}\\{$info->filename}";
            $info->params = get_class_vars($info->class);

            if (in_array($info->filename, ['Model'])) continue;

            if (! $email = \App\Models\Email::where('name', $info->filename)->first()) {
                $email = new \App\Models\Email;
                $email->name = $info->filename;
                $email->subject = $info->params['subject'];
                $email->body = str_replace("\n", "\n<br>\n", $info->params['body']);
                $email->save();
            }

            unset($info->params['subject'], $info->params['body']);
            $email->params = json_encode(array_map(function($value) {
                return "{{ \$$value }}";
            }, array_keys($info->params)));
            $email->save();
        }
    }
}
