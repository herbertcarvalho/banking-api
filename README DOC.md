#Objetivo
Implementar uma API interna de um banco.

#Funcionalidades Implementadas


1. 'getallusers' -> retorna todos os campos da tabela Users , Todos os usuários cadastrados no Banco

2. 'transferencias' -> retorna todos os campos da tabela Transferências especificando quem foi o doador e receptor.

3. 'contasporemail' -> retorna todas as contas de banco abertas por e-mail (deve ser passado como parâmetro).

4. 'getinfoaccount' -> retorna informações especificas de uma conta de banco(deve ser passado como parâmetro).

5. 'historicoporconta' -> retorna todo o histórico de transações referente a conta de banco(deve ser passado como parâmetro).

6. 'register' -> Requisição post que deve possuir o body especifico com e-mail,password e nome. Função :cadastrar um usuário no banco.

7. 'fazertransferencia' -> Requisição post que deve possuir body com conta doadora e receptora. Função : fazer transferência 
	de saldo e cadastra-la em outra tabela para o histórico. 

8. 'criarcontaagencia' -> Requisição post , body com apenas o e-mail o qual deve ser vinculado . Função : gerar uma nova conta
	e agencia pro usuário do e-mail.

9.'criarcadastroTableInfo' -> Requisição post , feita apos o  usuário ser registrado . Função : inserir as informações necessárias
	para criar uma conta e agencia.
	Motivação : Muitos App's como por exemplo PicPay, você pode apenas cadastrar seu email e terá uma forma de login mas
			para utilizar as diversas funcionalidades do App você deve concluir seu cadastro.


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



