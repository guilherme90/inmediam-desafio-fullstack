# InMediam API

- PHP >= 8
- Postgres
- Laravel

### Testes
Para executar os testes, crie um arquivo `.env.testing` e configure as variaveis de ambiente `DB_*`.

```
DB_HOST=127.0.0.1
DB_PORT=54321
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=password
```

#### Rodar migrations
```shell
php artisan migrate --env=testing
php artisan db:seed --env=testing
```

Depois, execute o comando:
```shell
php artisan test
```
