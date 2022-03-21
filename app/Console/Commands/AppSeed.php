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

        $user = \App\Models\User::firstOrNew(['id' => 1]);
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
        foreach($this->getFolderClasses('app/Mail') as $class) {
            $slug = get_class($class);

            $template = \App\Models\EmailsTemplates::firstOrNew(['slug' => $slug]);
            $template->name = $template->name? $template->name: $class->getSubject();
            $template->subject = $template->subject? $template->subject: $class->getSubject();
            $template->body = $template->body? $template->body: $class->getBody();
            $template->models = json_encode($class->getModels());
            $template->params = json_encode($class->getParams());
            $template->save();
        }
    }
}
