<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppSeed extends AppBase
{

    protected $signature = 'app:seed';
    protected $description = 'Cria registros básicos necessários no banco de dados';


    public function handle() {
        $this->rootGroupAndUser();
        $this->settingsCreate();
        $this->emailsTemplates();
    }


    public function rootGroupAndUser()
    {
        $group = \App\Models\UsersGroups::firstOrNew(['id' => 1]);
        $group->name = $group->name? $group->name: 'Root';
        $group->permissions = array_keys(config('permissions.keys', []));
        $group->save();

        $user = \App\Models\Users::firstOrNew(['id' => 1]);
        $user->name = $user->name? $user->name: 'Root User';
        $user->email = $user->email? $user->email: 'root@grr.la';
        $user->password = $user->password? $user->password: \Hash::make('321321');
        $user->group_id = $user->group_id? $user->group_id: $group->id;
        $user->save();
    }


    public function settingsCreate()
    {
        foreach(\App\Models\Settings::$settingsKeys as $key) {
            $setting = \App\Models\Settings::firstOrNew(['name' => $key]);
            $setting->value = $setting->value? $setting->value: config($key, '');
            $setting->save();
        }
    }


    public function emailsTemplates()
    {   
        foreach($this->getFolderClasses('app/Mails') as $class) {
            $template = \App\Models\EmailsTemplates::firstOrNew(['slug' => $class]);
            $template->name = call_user_func([$class, 'getName']);
            $template->subject = $template->subject? $template->subject: call_user_func([$class, 'getSubject']);
            $template->body = $template->body? $template->body: call_user_func([$class, 'getBody']);
            $template->body = is_array($template->body)? implode("\n", $template->body): $template->body;
            $template->params = json_encode(call_user_func([$class, 'getParamsValues']));
            $template->save();
        }
    }
}
