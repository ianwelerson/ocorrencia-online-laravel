# Sistema de Ocorrência Online - Trabalho de Conclusão de Curso

Arquivos referentes ao *Trabalho de Conclusão de Curso*, para o curso de Sistemas de Informação na [FAESA Centro Universitário](https://www.faesa.br/).

## Sobre
A proposta deste trabalho é fornecer uma recomendação de melhoria no processo de registro do boletim de ocorrência eletrônico, assim como fornecer para o cidadão uma maneira de consultar as ocorrências registradas com um feedback da Polícia Civil.
A proposta engloba também uma ferramente que visa fornecer ao cidadão uma maneira de consultar os registros de ocorrências em um determinado endereço de sua vontade, utilizando da geolocalização ou da entrada manual de endereço.

Para o desenvolvimento deste trabalho foi utilizado o framework PHP **Laravel** na versão **5.4**.
<br>
## Recomendação

Para um entendimento completo do funcionamento é recomendado a leitura da documentação sobre o [Laravel no site do framework](https://laravel.com/).
<br>
## Instalação

Para executar o projeto na sua máquina será necessário a instalação de algumas aplicações, e a realização de algumas configurações.

### Configuração do ambiente

O ambiente montado abaixo é exatamente o que foi executado durante o processo de desenvolvimento, por esse motivo ele é recomendado para a instalação local. Entretanto a execução da aplicação pode ser feita de outras maneiras a critério de quem está utilizando.

### Xampp

É recomendado a utilização do [XAMPP](https://www.apachefriends.org/pt_br/index.html) para montar o ambiente de desenvolvimento. Para realizar o download e instalação siga os passos abaixo. 
**Todo os passos de configuração do ambiente, e arquivos, levará em consideração a utilização do Xampp.**

1. Acesso o site do [XAMPP](https://www.apachefriends.org/pt_br/index.html)
2. Clique na opção *XAMPP para Windows 7.1.7 (PHP 7.1.7)* ou então [clique aqui](https://www.apachefriends.org/xampp-files/7.1.7/xampp-win32-7.1.7-0-VC14-installer.exe)
3. Execute a instalação.
4. Será pedido o diretório de instalação do Xampp. Recomendo que selecione *C:*, ficando *C:/Xampp*
5. Aguarde o final da instalação

Após instalar o Xampp, você poderá utilizar ele abrindo o atalho do *Xampp.exe* que deverá aparecer no menu iniciar.
Para inicializar o servidor, ou parar, basta abrir o *Xampp.exe* e clicar em *Start* nas duas primeiras opções: *Apache* e *MySql*, ambas devem ficar com o background verde.

#### Composer

O [Composer](https://getcomposer.org/) é uma ferramenta de gerenciamento de dependências para o PHP. Ele vai ser necessários para a instalação das dependências do Laravel.

1. Acesse o site do [Composer clicando aqui](https://getcomposer.org/)
2. Clique na opção de *download*
3. Clique no link *Composer-Setup.exe* e baixe o arquivo
4. Execute o instalador
5. No **passo 2** da instalação pode ser perguntado a localização do *php.exe*. Caso seja, busque o diretório */xampp/php/* e selecione o arquivo *php.exe* dentro dele. 
6. Avance até o final da instalação.

#### Arquivos do projeto

Baixe **INTEIRAMENTE** a pasta do [projeto](https://github.com/ianwelerson/ocorrencia-online-laravel) e siga os passos abaixo para realizar a instalação:

1. Acesse a pasta **htdocs** *(/Xampp/htdocs/)* dentro do local de instalação do XAMPP.
2. Cole a pasta **ocorrencia-online-laravel** baixado do Github.

O diretório do projeto deverá ficar */xampp/htdocs/ocorrencia-online-laravel*.

#### Banco de Dados

Dentro da pasta [database](https://github.com/ianwelerson/ocorrencia-online-laravel/tree/master/database) existe o arquivo .sql chamado *base.sql*. Este arquivo possuí todas as configurações de base de dados para o banco, sem nenhuma inserção ou registro. 

Siga os passos abaixo para realizar a instalação:

1. Acesse o endereço *http://localhost/phpmyadmin/* no seu navegador.
3. Acesse a opção *Importar* no menu superior
4. Acesse o diretório onde estão os arquivos do projetos
5. Dentro da pasta *database* selecione o arquivo *base.sql*
6. Clique na opção *Executar*

Seguindo os passos o banco de dados irá ficar configurado corretamente.

#### Configurações do Laravel

Acesse a pasta onde estão os arquivos do laravel, é a pasta *application*, que está dentro da pasta *ocorrencia-online-laravel* que foi baixada anteriormente.

1. Faça uma cópia do arquivo **.env.example** e altere o nome do arquivo para **.env**. Pode ser que o Sistema Operacional não permita a alteração diretamente, utilize então o notepad ou um editor de código.
2. Abra o arquivo **.env**, pode ser com o editor de texto, e altere as linhas abaixo com os dados do banco de dados, geralmente o padrão é o que já está configurado:
```
DB_USERNAME=root
DB_PASSWORD=
```
3. Apertando a tecla *SHIFT* do teclado, clique com o *botão direito do mouse* dentro da pasta **application** e selecione *Abrir Janela do PowerShell aqui* (ou *Abrir Janela de Comando aqui*)
4. Digite os comando abaixo na ordem:
```
composer install
composer dumpautoload -o
php artisan config:cache
artisan config:clear
php artisan route:cache
php artisan key:generate
php artisan db:seed
php artisan storage:link
artisan config:clear
exit
```
5. Abra o *Xampp.exe* e clique em **start** nas opções MySql e Apache.
6. Abra **novamente** o *PowerShell*, ou *Janela de Comando*, dentro da pasta do projeto *(Apertando a tecla *SHIFT* do teclado, clique com o *botão direito do mouse* dentro da pasta **application** e selecione *Abrir Janela do PowerShell aqui* ou *Abrir Janela de Comando aqui*)* e digite o comando abaixo:
```
php artisan serve
```
7. O comando anterior irá retornar um endereço local, provavelmente *127.0.0.1:8000*. Digite o endereço no navegador e será possível utilizar a aplicação.
>Obs.: Esse processo é somente para um teste local, e poderá existir problemas na execução da aplicação por problemas de servidor.

<br>

## O que foi utilizado no projeto?

### [Laravel](https://laravel.com/)
```
Laravel Framework 5.4.33
```

### [Materialize CSS](http://materializecss.com/)
```
Materialize v0.100.2
```

<br>

>Data de **Início** do projeto: 20 de Agosto de 2017.
>Data de **Finalização** do projeto: 15 de Outubro de 2017

<br><br>

![imagem tha's all folks](https://img09.deviantart.net/0248/i/2013/295/d/8/that_s_all_folks__by_surrimugge-d6rfav1.png)
