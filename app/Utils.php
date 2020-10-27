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
            'from' => config('mail.from'),
            'to' => '',
            'subject' => '',
            'body' => '',
        ], $data);
        
        return \Mail::to($data['to'])->send(new \App\Mail\Mail($data));
    }
}