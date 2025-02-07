# README do Projeto de Controle de Estoque

## Descrição

Este projeto é um sistema de controle de estoque desenvolvido com o framework Laravel. Ele permite gerenciar produtos, fornecedores e movimentações de entrada e saída de estoque.

## Pré-requisitos

Antes de executar o projeto, você precisa ter instalado em sua máquina:

-   [PHP](https://www.php.net/downloads)
-   [Composer](https://getcomposer.org/download/)
-   [Node.js](https://nodejs.org/en/download/)
-   [Laravel](https://laravel.com/docs/8.x/installation)

## Instalação

1. **Clone o repositório:**

    ```bash
    git clone https://github.com/ardotheedu/desafio
    cd desafio
    ```

2. **Instale as dependências do PHP:**

    ```bash
    composer install
    ```

3. **Instale as dependências do Node.js:**

    ```bash
    npm install
    ```

4. **Crie um arquivo `.env`:**

    Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as configurações do banco de dados.

    ```bash
    cp .env.example .env
    ```

5. **Gere a chave da aplicação:**

    ```bash
    php artisan key:generate
    ```

6. **Execute as migrações do banco de dados:**

    ```bash
    php artisan migrate
    ```

## Execução

Para iniciar o servidor de desenvolvimento, execute:

composer run dev
