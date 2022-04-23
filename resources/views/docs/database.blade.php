## Migration

Criar tabelas na mão pode ser um pouco maçante, mesmo utilizando sua ferramente favorita para gerenciá-las.
Execute o comando abaixo para criar uma tabela básica, e a partir dela modelar conforme necessário:

```bash
php artisan app:table-generate
```

O comando irá lhe pedir um nome para a tabela, e a partir disso,
gerá-la com as colunas `id, slug, name, created_at, updated_at e deleted_at`.
Você pode renomear ou remover alguma dessas colunas caso necessário,
**embora seja fortemente sujerido que você as mantenha**, visto que
o sistema as usa para que você precise digitar o mínimo de código possível.

Não se esqueça de executar o comando abaixo assim que criar ou modificar uma tabela
para que o sistema gere ou customize as models, controllers e views para você

```bash
php artisan app:sync
```

## Seed
O comando criado especificamente para gerar registros básicos para o funcionamento no banco é:

```bash
php artisan app:seed
```

Entretanto, `php artisan app:install` também tem a responsabilidade sobre esse comando,
portanto você não precisa executá-lo novamente após o processo de instalação.
O usuário padrão do sistema é `root@grr.la` e sua senha é `321321`. Troque-os no primeiro acesso.