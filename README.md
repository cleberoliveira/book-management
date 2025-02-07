# Book Management

Este é um sistema de gerenciamento de livros desenvolvido com Laravel, que permite o cadastro e gerenciamento de livros e autores, com uma API RESTful e interface web.

## 🚀 Funcionalidades

- Autenticação de usuários
- Gerenciamento de livros (CRUD)
- Gerenciamento de autores (API)
- API RESTful para integração com outros sistemas
- Interface web responsiva

## 📋 Pré-requisitos

- PHP >= 8.1
- Composer
- MySQL
- Node.js e NPM
- Laravel CLI

## 🔧 Instalação

1. Clone o repositório
```bash
git clone [url-do-repositório]
cd book-management
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do Node.js
```bash
npm install
```

4. Configure o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure o banco de dados no arquivo `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_management
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

6. Execute as migrações e seeders
```bash
php artisan migrate --seed
```

7. Crie o link simbólico para o storage
```bash
php artisan storage:link
```

8. Compile os assets
```bash
npm run dev
```

9. Inicie o servidor
```bash
php artisan serve
```

## 👤 Usuários para Teste

### Interface Web
- Email: admin@demo.com
- Senha: 1234

- Email: user@demo.com
- Senha: 1234

### API
Use as mesmas credenciais acima para obter o token de autenticação.

## 🔗 Testando a API com Postman

1. Importe a coleção do Postman disponível em `docs/apitest_postman_collection.json`

2. Autenticação da API:
   - Faça uma requisição POST para `/api/login` com email e senha
   - O token retornado deve ser usado no header `Authorization: Bearer {token}`

### Endpoints Principais

#### Autenticação
- POST `/api/login` - Login
- POST `/api/logout` - Logout

#### Livros
- GET `/api/books` - Lista todos os livros
- POST `/api/books` - Cria um novo livro
- GET `/api/books/{id}` - Obtém detalhes de um livro
- PUT `/api/books/{id}` - Atualiza um livro
- DELETE `/api/books/{id}` - Remove um livro

#### Autores
- GET `/api/authors` - Lista todos os autores
- POST `/api/authors` - Cria um novo autor
- GET `/api/authors/{id}` - Obtém detalhes de um autor
- PUT `/api/authors/{id}` - Atualiza um autor
- DELETE `/api/authors/{id}` - Remove um autor


## 📄 Licença

Este projeto está sob a licença MIT - veja o arquivo [LICENSE.md](LICENSE.md) para detalhes
