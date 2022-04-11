<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppInstall extends AppBase
{

    protected $signature = 'app:install';
    protected $description = 'Instalação da aplicação';

    public function handle() {
        // $this->call('db:wipe');

        // if (! \Schema::hasTable('migrations')) {
        //     $this->call('migrate');
        //     // $this->call('db:seed');
        //     $this->call('app:seed');
        //     return;
        // }

        if (! \Schema::hasTable('users')) {
            try {
                include database_path('schema.php');
            }
            catch(\Exception $e) {
                $this->error('O erro abaixo foi retornado ao tentar instalar as tabelas do banco:');
                $this->error($e->getMessage());
                $this->warn('Para tentar corrigir o erro, execute os comandos abaixo no seu banco e tente instalar novamente:');
                $this->warn('SET FOREIGN_KEY_CHECKS = 0;');
                $this->warn('SET GLOBAL FOREIGN_KEY_CHECKS = 0;');
                return;
            }

            $this->call('app:seed');
        }

        $this->comment('System already intalled. Run db:wipe to clear tables');
    }
}
