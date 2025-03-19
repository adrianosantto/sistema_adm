## Requisitos

* PHP 8.2 ou superior
* MySQL 8.0 ou Superior
* Composer

## Rodar o projeto baixado

Instlar as dependências.
```
Composer Install
``` 



## Sequencia para criar o projeto

Criar o arquivo Composer.json com a instrução básica.
```
Composer init
```
Instalar as dependencias monolog, biblioteca php que permite criar arquivos de log
``` 
composer require monolog/monolog
```

## Como usar o Github
Baixar do Git
´´´
git clone --branch <branch_name> <repository_url>
´´´

Verificar a branch.
´´´
git branch
´´´

Baixar as atulizações.
´´´
git pull
´´´
Adicionar todos os arquivos modificado no staging

´´´
git add .
´´´
Commit: Documentar o que foi feito no ponto especifico do projeto
´´´
git commit -m "Descrição do commit"
´´´
Enviar os commits locais para o repositótio remoto
´´´
git push origin dev-master
´´´