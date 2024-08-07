# Setup Docker PHP MySQL Laravel - Cadastrar livros
### Para executar o projeto siga as orientações abaixo.

## Instruções

Baixa o repositorio

```
git clone https://github.com/oguh33/cadastro-livros.git
```
Acessar o diretório app e rodar o composer.

```
composer install 
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

Acessando o container do projeto e criando as tabelas de banco via migrations.
```
docker-compose exec app bash 
cd app
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
