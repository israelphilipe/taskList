# Task list

# Detalhes do projeto:

## O projeto se trata de uma lista de tarefas, onde pode-se:
1. Criar uma tarefa
1. Atualizar seu estado entre feita e não feita
1. Excluí-la
1. Filtrar entre todas as tarefas, concluídas e pendentes

## O que foi feito?

1. Criar uma aplicação web utilizando PHP usando o Framework Laravel
    * Utilizando o laravel para o backend como api consumida por cliente Vue.js
1. Utilizar persistência em um banco de dados Postegres SQL
    * O banco utilizado para guardar os dados foi postgres SQL
1. Utilizar Eloquent ORM
    * O Eloquent foi utlizado para facilitar a comunicação com o banco de dados
1. Utilizar Bootstrap 4
    * O bootstrap 4 foi utilizado para estilizar alguns componentes do Vue.js
1. Utilizar Teste Unitarios com PHPUnit
    * Foram feitos testes unitários e testes de features utilziando o PHPunit
1. Criar single page app utilizando VueJS, React ou Angular
    * Foi criado uma página em Vue.js que se comunica com a api laravel. (Single Page Aplication)
1. Publicar projeto no heroku
    * [O projeto foi publicado neste link](https://itasklist.herokuapp.com/)


## Rodar localmente

## Requisitos:
1. php 7.x
1. node 14.x
1. npm 6.x
1. composer versão = 2.x
1. git
1. PostgresSQL


## Instruções:

1. Clonar o repositório

    ```sh
    $ git clone https://github.com/israelphilipe/taskList
    ```
1. Entrar na pasta do projeto
    ```sh
    $ cd taskList
    ```
1. Instalar os pacotes necessários pro Laravel
    ```sh
    $ composer install
    ```
1. Instalar os pacotes necessários para o Vue.js
    ```sh
    $ npm install
    ```
1. Criar um banco com um nome qualquer no postgres

1. Criar um usuário com senha no postgres

1. Copiar o .env.example e mudar as variáveis para:
    * DB_CONNECTION=pgsql
    * DB_HOST=localhost
    * DB_PORT=5432
    * DB_DATABASE=nome_que_você_escolheu
    * DB_USERNAME=usuario_que_você_criou
    * DB_PASSWORD=senha_que_você_criou

1. Rodar as migrações do laravel
   ```sh
    $ php aritsan migrate
    ```

1. Rodar o servidor laravel
    ```sh
    $ php aritsan serve
    ```

1. Fazer o build do projeto vue
    ```sh
    $ npm run dev
    ```
1. Caso não queira ficar rodando o primeiro comando sempre que mudar algo
    ```sh
    $ npm run watch
    ```
    <br>
    


