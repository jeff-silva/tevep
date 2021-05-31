<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $root = \App\Models\User::find(1);

        if (! $root) {
            \DB::table('users')->insert([
                'name' => 'Root User',
                'email' => 'root@grr.la',
                'password' => Hash::make('321321'),
            ]);
            $root = \App\Models\User::find(1);
        }

        // Settings

        // Email templates
        foreach(glob(app_path('Mail') .'/*.php') as $file) {
            $file = realpath($file);
            $class = pathinfo($file, PATHINFO_FILENAME);
            $namespace = "\App\Mail\\{$class}";

            if (! $email = \App\Models\Email::where('name', $class)->first()) {
                \App\Models\Email::create([
                    'name' => $class,
                    'subject' => call_user_func([$namespace, 'getSubject']),
                    'body' => call_user_func([$namespace, 'getBody']),
                    'params' => call_user_func([$namespace, 'getParams']),
                ]);
            }
        }
    }
}
