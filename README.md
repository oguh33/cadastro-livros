
# 📚 Desafio do Teste Técnico Spassu - Cadastro de Livros
Este projeto foi desenvolvido para o Desafio do Teste Técnico Spassu. O objetivo do desafio é criar um sistema para cadastro de livros utilizando boas práticas de desenvolvimento.

## 🚀 Tecnologias Utilizadas

- **Docker**: Para conteinerização do ambiente de desenvolvimento.
- **PHP 8.3.6**: Linguagem de programação utilizada no backend.
- **Laravel**: Framework PHP utilizado para estruturação do projeto.
- **MySQL 8.0**: Banco de dados relacional para armazenamento das informações dos livros.

### 📝 Siga as instruções abaixo para configurar e executar o projeto.

## 🛠️ Instruções

1. **Clone o repositório:**  
   ```bash
   git clone https://github.com/oguh33/cadastro-livros.git
   ```

2. **Inicie o serviço Docker:**  
   Se o Docker não estiver iniciado, suba o serviço com o seguinte comando:

   - **Primeira execução (com build):**  
     ```bash
     docker-compose up --build 
     ```

   - **Execuções subsequentes (sem build):**  
     ```bash
     docker-compose up -d
     ```

3. **Acesse o container da aplicação:**  
   Entre no container da aplicação para rodar o Composer:
   ```bash
   docker-compose exec app bash
   ```

4. **Configure o Composer:**  
   Navegue até o diretório da aplicação e instale as dependências do Composer:
   ```bash
   cd app
   composer install 
   ```

5. **Crie o arquivo `.env`:**  
   Crie uma cópia do arquivo `.env.example` para configurar as variáveis de ambiente:
   ```bash
   cp .env.example .env
   ```

6. **Execute as migrações do banco de dados:**  
   Crie as tabelas do banco de dados usando as migrações do Laravel:
   ```bash
   php artisan migrate
   ```

7. **Finalize e saia do container (opcional):**  
   Após rodar as migrações, você pode sair do container:
   ```bash
   exit
   ```

8. **Acesse a aplicação:**  
   O serviço estará disponível na porta 8000. Clique [aqui](http://localhost:8000) para acessar a aplicação.
   ```bash
   http://localhost:8000
   ```
