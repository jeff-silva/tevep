<?php

// composer require nette/php-generator
// https://github.com/nette/php-generator

namespace App\Console\Commands;

class AppPermissions extends AppBase
{

    protected $signature = 'app:permissions';
    protected $description = 'Gera arquivo de configuração de permissões baseado em tables';

    public function handle() {

        $config_permissions = config('permissions', []);
        $config_permissions = array_merge([
            'keys' => [],
        ], $config_permissions);

        $config_permissions = $this->addPermissionKey($config_permissions, 'admin-settings', 'Configurações principais');
        $config_permissions = $this->addPermissionKey($config_permissions, 'admin-settings-email', 'Configurações de e-mail');
        $config_permissions = $this->addPermissionKey($config_permissions, 'admin-settings-files', 'Configurações de arquivos');

        $content = implode("\n", [
            '<?php',
            '',
            '/*',
            ' * COMO GERAR PERMISSÕES PARA O FRONTEND?',
            ' * Todos as páginas do Nuxt tem um "name" que geralmente',
            ' * seguem a seguinte lógica:',
            ' * ',
            ' * /pages/admin/products/index.vue => admin-product',
            ' * /pages/admin/products/_id.vue => admin-product-id',
            ' * ',
            ' * Para criar uma permissão para acessar a página "admin-product-id",',
            ' * basta inserir este valor em "keys":',
            ' * ',
            ' * \'admin-product-id\' => \'Acessar edição de produto\',',
            ' * ',
            ' * COMO GERAR PERMISSÕES PARA O BACKEND?',
            ' * Ao gerar uma rota no Laravel, dê um "name" à ela',
            ' * utilizando o método ->name(\'algum-name\').',
            ' * As permissões só podem ser aplicadas às rotas com name.',
            ' * Feito isso, basta inserir o "name" da rota em "keys"',
            ' * associando-a com uma descrição:',
            ' * ',
            ' * \'products-save\' => \'Alterar dados de produtos\',',
            ' * ',
            ' * É só isso mesmo. As permissões são verificadas automaticamente',
            ' * tanto no front quanto no back. Você só precisa se atentar',
            ' * aos "names" das rotas.',
            ' */',
            '',
            ('return '. $this->varExport($config_permissions) .';'),
        ]);

        file_put_contents(config_path('permissions.php'), $content);
    }

    public function addPermissionKey($config_permissions, $key, $name)
    {
        if (! isset($config_permissions['keys'][ $key ])) {
            $config_permissions['keys'][ $key ] = $name;
        }

        return $config_permissions;
    }
}
