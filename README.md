# NUTRIFMG: SISTEMA PARA OTIMIZAR A AVALIAÇÃO ANTROPOMÉTRICA DOS ESTUDANTES DOS CURSOS TÉCNICOS INTEGRADOS DO IFMG - CAMPUS SÃO JOÃO EVANGELISTA

-----
## Configurando o projeto na sua máquina
Link da documentação do Laravel https://laravel.com/docs

1. Você vai precisar instalar o Composer, ele vai gerenciar todas as dependências do projeto 

2. Edite a variável Path do Windows adicionando o Composer

3. Instale o laravel na sua máquina

**composer global require laravel/installer**

Edite a variável Path do Windows, o caminho padrão é esse C:\Users\waism\AppData\Roaming\Composer\vendor\bin
Substitua "waism" pelo usuário da sua máquina.

4. Crie um novo arquivo na raiz do projeto com o nome ".env" copie o conteúdo do arquivo ".env.example" e cole no arquivo criado.

5. Instale as dependências do projeto
Execute o comando na raiz do projeto: 

**composer install** 

Observação: Se der algum erro execute o comando abaixo:

**composer update**

6. Execute os seguintes comandos:

**php artisan key:generate** 
Vai gerar uma key para criptografia

Antes do próximo comando crie um banco de dados no Mysql - foi o que utilizamos- com o nome "tcclaravel", lembrando que pode ser qualquer nome, desde que você altere o nome no arquivo .env

**php artisan migrate --seed**
Vai criar o banco de dados para você e o usuário padrão, se esquecer de digitar o "-seed" rode o comando : **php artisan db:seed**

O usuário padrão pode ser consultado em: tcc-luan-waisman > database > seeds


**php artisan serve**
Vai criar um servidor, exemplo: http://127.0.0.1:8000 e você já poderá visualizar o projeto. Se você estiver utilizando o Xampp ou outro precisará acessar a pasta public. Exemplo: http://localhost/tcc-luan-josue/public

