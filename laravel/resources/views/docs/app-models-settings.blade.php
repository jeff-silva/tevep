## Configurações

As configurações são definidas na model \App\Models\Settings, no atributo $settingsKeys.
Lá é informado uma lista de configs que estão disponíveis para serem alteradas.


## Model App\Models\Settings

Ela é responsável pelas configurações do sistema.<br>
Vamos supor que você queira configurar uma imagem padrão para produtos sem foto.
então vamos criar o arquivo `/config/app_models_products.php` que pelo nome, 
obviamente terá configurações relacionadas à model de produtos, e nela vamos definir:

```php
[php // /config/app_models_products.php

return [
   'nophoto' => '/assets/products/nophoto.jpg',
];
```
Agora você pode recuperar esse valor simplesmente usando `config('app_models_products.nophoto')` a qualquer momento.
No entanto, precisamos que esse valor possa ser guardado no banco de dados para persistir da maneira correta,
e essa parte já está pronta. Tudo o que temos que fazer é falar para o sistema quais chaves podem persistir
do banco abrindo o arquivo `/config/app-models-settings.php` e inserindo a chave `app_models_products.nophoto`
dentro das arrays `front` ou `back`. A diferença entre uma e outra é que o que estiver dentro de `front` será
enviado para o frontend, portanto é uma péssima ideia inserir nele senhas, chaves privadas ou outros dados sensíveis.
Já o `back` serve para informar todos os outros dados sensíveis, eles nunca irão para o front.