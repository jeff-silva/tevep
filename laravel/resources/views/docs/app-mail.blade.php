## Templates de e-mail

Crie uma classe de email em `app/Mail` seguindo as outras classes como exemplo.
Abaixo, vamos usar o exemplo de um e-mail com detalhes de um pedido para o cliente:

```php
[php

namespace App\Mails;

class NewShopOrder
{
    use \App\Traits\Mail;

    public function __construct($order_id)
    {
        $order = \App\Models\ShopOrder::find($order_id);
        $user = \App\Models\Users::find($this->order->user_id);
        $this->setData(compact('order', 'user'));
    }

    
    // Nome que será exibido na lista de templates
    static function getName()
    {
        return 'Novo pedido';
    }


    // Assunto do e-mail que será exibido para o cliente
    static function getSubject()
    {
        return 'Dados do pedido de @{{ $user->name }}';
    }


    // Conteúdo do e-mail que o cliente receberá
    static function getBody()
    {
        return [
            '<p>Olá @{{ $user->name }}. Veja abaixo o detalhamento do seu pedido:</p>',
            '...',
        ];
    }


    // Aqui você pode inserir todos os parâmetros que o administrador
    // pode customizar no assunto e corpo do e-mail.
    static function getParams()
    {
        return [
            '$email' => 'E-mail contatado',
            '$tevep->name' => 'Nome do Tevep',
            '$tevep->link()' => 'Link do Tevep',
        ];
    }


    // Você pode definir uma chamada de teste simulando um envio de e-mail,
    // para que um administrador possa verificar como um cliente recebe um e-mail.
    static function test()
    {
        $order_id = \App\Models\ShopOrders::select(['id'])->inRandomOrder()->limit(1)->value('id');
        return new self($order_id);
    }
}
```

Ao configurar todos os atributos, execute o comando `php artisan app:sync` e deixe
que o sistema se encarregue de popular este template de e-mail novo para o banco de dados.
Após isso, tudo o que você precisa fazer é clicar em editar o template pelo admin.