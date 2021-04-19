# Prova Innova Connect

### Tecnologias

- Lumen v8
- VueJS 2 + Bootstrap v5
- MySQL
- Docker

## Instalação

Entre na pasta raiz do projeto e digite o seguinte comando:
```sh
docker-compose up -d
```

Após executar este comando, o backend vai iniciar na seguinte URL: http://localhost:8025.
Depois de subir o Docker, fazer a configuração do banco de dados no .env na pasta backend.
Depois de ter feito a configuração do banco de dados, entrar no Docker e executar o comando:
```sh
composer install
```
Após executar o comando acima, execute este:
```sh
php artisan migrate
```

Pronto, o backend está configurado.

Agora entre na pasta frontend e execute o comando:
```sh
npm install
```
Após executar o comando acima, execute:
```sh
npm run serve
```

E pronto, sistemas configurados.
