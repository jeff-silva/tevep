<?php

/*
 * COMO GERAR PERMISSÕES PARA O FRONTEND?
 * Todos as páginas do Nuxt tem um "name" que geralmente
 * seguem a seguinte lógica:
 * 
 * /pages/admin/products/index.vue => admin-product
 * /pages/admin/products/_id.vue => admin-product-id
 * 
 * Para criar uma permissão para acessar a página "admin-product-id",
 * basta inserir este valor em "keys":
 * 
 * 'admin-product-id' => 'Acessar edição de produto',
 * 
 * COMO GERAR PERMISSÕES PARA O BACKEND?
 * Ao gerar uma rota no Laravel, dê um "name" à ela
 * utilizando o método ->name('algum-name').
 * As permissões só podem ser aplicadas às rotas com name.
 * Feito isso, basta inserir o "name" da rota em "keys"
 * associando-a com uma descrição:
 * 
 * 'products-save' => 'Alterar dados de produtos',
 * 
 * É só isso mesmo. As permissões são verificadas automaticamente
 * tanto no front quanto no back. Você só precisa se atentar
 * aos "names" das rotas.
 */

return [
  'keys' => [
    'admin-settings' => 'Configurações principais',
    'admin-settings-email' => 'Configurações de e-mail',
    'admin-settings-files' => 'Configurações de arquivos',
    'files-save' => 'Salvar arquivos',
    'files-delete' => 'Deletar arquivos',
    'admin-files' => 'Listar arquivos',
    'admin-files-id' => 'Editar arquivos',
  ],
];