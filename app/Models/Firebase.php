<?php

/*

Acessar seu projeto, por exemplo:
https://console.firebase.google.com/project/sysapp-611bb/settings/serviceaccounts/adminsdk

Clicar em "Gerar nova chave" para fazer download do credentials.json

Pegar o conteúdo do arquivo e converter para base64 e colocar o valor em FIREBASE_CREDENTIALS_BASE64_JSON

*/

namespace App\Models;

class Firebase
{
    static $database;

    static function database() {
        if (! self::$database) {
            $credentials = json_decode(base64_decode(env('FIREBASE_CREDENTIALS_BASE64_JSON')), true);
            self::$database = (new \Kreait\Firebase\Factory)->withServiceAccount($credentials)->createDatabase();
        }
        return self::$database;
    }


    static function databaseSave($key, $value) {
        $database = self::database();
        return $database->getReference($key)->set($value);
    }
}