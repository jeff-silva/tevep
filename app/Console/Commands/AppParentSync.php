<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppParentSync extends AppBase
{

    protected $signature = 'app:parent-sync';
    protected $description = 'Instalação da aplicação';

    public function handle() {
        $app_parent = env('APP_PARENT');
        if (!$app_parent) return $this->comment('APP_PARENT não definido');

        $files = [];

        $files = $this->filesList($files, 'app/Exceptions/Handler.php');
        $files = $this->filesList($files, 'app/Http/Controllers/Controller.php');
        $files = $this->filesList($files, 'app/Providers/AppServiceProvider.php');
        $files = $this->filesList($files, 'app/Console/Commands/App*.php');
        $files = $this->filesList($files, 'app/Models/Files.php');
        $files = $this->filesList($files, 'app/Models/Settings.php');
        $files = $this->filesList($files, 'app/Providers/AppServiceProvider.php');
        $files = $this->filesList($files, 'app/Traits/Mail.php');
        $files = $this->filesList($files, 'app/Traits/Model.php');
        $files = $this->filesList($files, 'app/Mail/*.php');
        $files = $this->filesList($files, 'database/migrations/*_create_users_table.php');
        $files = $this->filesList($files, 'database/migrations/*_create_password_resets_table.php');
        $files = $this->filesList($files, 'database/migrations/*_create_failed_jobs_table.php');
        $files = $this->filesList($files, 'database/migrations/*_create_personal_access_tokens_table.php');
        $files = $this->filesList($files, 'database/migrations/2022_01_01_000000_create_files_table.php');
        $files = $this->filesList($files, 'database/migrations/2022_01_01_000000_create_pages_table.php');
        $files = $this->filesList($files, 'database/migrations/2022_01_01_000000_create_settings_table.php');
        $files = $this->filesList($files, 'client/app.js');
        $files = $this->filesList($files, 'client/app.css');
        $files = $this->filesList($files, 'client/middleware/permission.js');
        $files = $this->filesList($files, 'client/components/ui/**/*.vue');
        $files = $this->filesList($files, 'client/components/ui/*.vue');
        $files = $this->filesList($files, 'client/layouts/default/*.vue');
        $files = $this->filesList($files, 'client/pages/admin/files/*.vue');
        $files = $this->filesList($files, 'client/pages/admin/settings/email.vue');
        $files = $this->filesList($files, 'client/pages/admin/settings/files.vue');
        $files = $this->filesList($files, 'client/pages/admin/settings/index.vue');
        $files = $this->filesList($files, 'client/pages/admin/dev/*.vue');
        $files = $this->filesList($files, 'client/pages/admin/dev/**/*.vue');

        foreach($files as $from_file) {
            $here = $this->fileInfo($from_file);
            $there = $this->fileInfo(str_replace(base_path(), $app_parent, $from_file));
            
            // If contents are different
            if ($here->content != $there->content) {
                
                // subir
                if ($here->modified > $there->modified) {
                    $this->comment("⇈ {$there->path}");
                    if (!file_exists($there->dirname)) mkdir($there->dirname, 0777, true);
                    file_put_contents($there->path, $here->content);
                }

                // baixar
                else if ($here->modified < $there->modified) {
                    $this->comment("⇊ {$there->path}");
                    if (!file_exists($here->dirname)) mkdir($here->dirname, 0777, true);
                    file_put_contents($here->path, $there->content);
                }
            }
        }
    }

    public function fileInfo($path) {
        $path = preg_replace('/\\\+/', DIRECTORY_SEPARATOR, $path);
        $file = (object) array_merge(['path' => $path], pathinfo($path));
        $file->file_exists = file_exists($path);
        $file->folder_exists = file_exists($file->dirname);
        $file->is_dir = is_dir($path);
        $file->modified = $file->file_exists? \File::lastModified($path): 0;
        $file->content = (!$file->is_dir AND $file->file_exists)? file_get_contents($file->path): null;
        return $file;
    }

    public function filesList($files, $path) {

        if (strpos($path, '*') !== false) {
            foreach(glob($path) as $ppath) {
                $files[] = realpath(base_path($ppath));
            }
        }
        else {
            $files[] = realpath(base_path($path));
        }

        return $files;
    }
}
