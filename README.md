# Setup Docker PHP MySQL Laravel - Cadastrar livros
### Para executar o projeto siga as orientações abaixo.

## Instruções

Baixa o repositorio

```
git clone https://github.com/oguh33/cadastro-livros.git
```

Subir o serviço docker, caso não esteja iniciado

Primeira vez, fazer um build

```
docker-compose up --build 
```

Outras vezes
```
docker-compose up -d
```

Acessar o diretório app e rodar o composer.
```
docker-compose exec app bash
```
```
cd app
```
```
composer install 
```

Ainda no container e na pasta app vamos criando o arquivo .env
```
cp .env.example .env
```


Dentro do container do projeto e criando as tabelas de banco via migrations.
```
php artisan migrate
```

Após rodar as migrations pode sair da máquina (container)
```
exit
```

Serviço disponível na porta 8000

```
http://localhost:8000
```
