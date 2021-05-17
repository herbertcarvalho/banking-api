# Objective
Your assignment is to build an internal API for a fake financial institution using PHP and Laravel.

# Brief
While modern banks have evolved to serve a plethora of functions, at their core, banks must provide certain basic features. Today, your task is to build the basic HTTP API for one of those banks! Imagine you are designing a backend API for bank employees. It could ultimately be consumed by multiple frontends (web, iOS, Android etc).

# Tasks
- Implement assignment using:
- Language: PHP
- Framework: Laravel
- There should be API routes that allow them to:
- Create a new bank account for a customer, with an initial deposit amount. A single customer may have multiple bank accounts.
- Transfer amounts between any two accounts, including those owned by different customers.
- Retrieve balances for a given account.
- Retrieve transfer history for a given account.
- Write tests for your business logic
- Feel free to pre-populate your customers with the following:

[
  {
    "id": 1,
    "name": "Arisha Barron"
  },
  {
    "id": 2,
    "name": "Branden Gibson"
  },
  {
    "id": 3,
    "name": "Rhonda Church"
  },
  {
    "id": 4,
    "name": "Georgina Hazel"
  }
]

You are expected to design any other required models and routes for your API.

# Evaluation Criteria
- PHP best practices
- Completeness: did you complete the features?
- Correctness: does the functionality act in sensible, thought-out ways?
- Maintainability: is it written in a clean, maintainable way?
- Testing: is the system adequately tested?
- Documentation: is the API well-documented?

# CodeSubmit

Please organize, design, test and document your code as if it were going into production - then push your changes to the master branch. After you have pushed your code, you may submit the assignment on the assignment page.

All the best and happy coding!


# Objetivo

Implementar uma API interna de um banco.

# Funcionalidades Implementadas


- 'getallusers' -> retorna todos os campos da tabela Users , Todos os usuários cadastrados no Banco

- 'transferencias' -> retorna todos os campos da tabela Transferências especificando quem foi o doador e receptor.

- 'contasporemail' -> retorna todas as contas de banco abertas por e-mail (deve ser passado como parâmetro).

- 'getinfoaccount' -> retorna informações especificas de uma conta de banco(deve ser passado como parâmetro).

- 'historicoporconta' -> retorna todo o histórico de transações referente a conta de banco(deve ser passado como parâmetro).

- 'register' -> Requisição post que deve possuir o body especifico com e-mail,password e nome. Função :cadastrar um usuário no banco.

- 'fazertransferencia' -> Requisição post que deve possuir body com conta doadora e receptora. Função : fazer transferência 
	de saldo e cadastra-la em outra tabela para o histórico. 

- 'criarcontaagencia' -> Requisição post , body com apenas o e-mail o qual deve ser vinculado . Função : gerar uma nova conta
	e agencia pro usuário do e-mail.

- 'criarcadastroTableInfo' -> Requisição post , feita apos o  usuário ser registrado . Função : inserir as informações necessárias
	para criar uma conta e agencia.
	Motivação : Muitos App's como por exemplo PicPay, você pode apenas cadastrar seu email e terá uma forma de login mas
			para utilizar as diversas funcionalidades do App você deve concluir seu cadastro.

# Preparação para testes de API

Para rodar a API em sua maquina deve possuir o MySql , Apache e PHP. 
	Foram utilizadas as ultimas versões das tecnologias(16/05/2021).

Apos a instalação das tecnologias procure o arquivo .ENV e modifique-o para atender o banco utilizado , é necessário criar o DB no
	MySql antes de especifica-lo no .ENV .

Apos selecionar o banco no arquivo .ENV , o próximo passo é a migração do banco que vai ser feita pelo comando php

 "php artisan migrate"

Foram criadas algumas contas para fins de testes , para obter essas contas digite o comando

 "php artisan db:seed"

A partir de agora , o banco está criado e populado. Bastar colocar a API para rodar com o comando

 "php artisan serve"

Bons testes!!!




