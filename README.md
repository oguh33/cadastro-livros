
# Setup Docker PHP MySQL Laravel - Cadastrar Livros

### Siga as instruções abaixo para configurar e executar o projeto.

## Instruções

1. **Clone o repositório:**
   ```
   git clone https://github.com/oguh33/cadastro-livros.git
   ```

2. **Inicie o serviço Docker:**
   Se o Docker não estiver iniciado, suba o serviço com o seguinte comando:

   - **Primeira execução (com build):**
     ```
     docker-compose up --build 
     ```

   - **Execuções subsequentes (sem build):**
     ```
     docker-compose up -d
     ```

3. **Acesse o container da aplicação:**
   Entre no container da aplicação para rodar o Composer:
   ```
   docker-compose exec app bash
   ```

4. **Configure o Composer:**
   Navegue até o diretório da aplicação e instale as dependências do Composer:
   ```
   cd app
   composer install 
   ```

5. **Crie o arquivo `.env` a partir de uma copia do arquivo `.env.example`:**
   Ainda dentro do container e no diretório `app`:
   ```
   cp .env.example .env
   ```

6. **Execute o comando de migrations do banco de dados:**
   Ainda no container, crie as tabelas do banco de dados usando as migrações:
   ```
   php artisan migrate
   ```

7. **Finalize e saia do container (opcional):**
   Após rodar as migrações, você pode sair do container:
   ```
   exit
   ```

8. **Acesse a aplicação:**
   O serviço estará disponível na porta 8000:
   ```
   http://localhost:8000
   ```
