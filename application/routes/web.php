<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------------------------------ Área destinada ao usuário ------------------------------

// Rota para view basica de exibição da tela com os links disponíveis para usuários
Route::get('/', function () {
    return view('Index/padrao-index');
});

// Verifica se o usuário está autenticado (As rotas dentro do grupo só podem ser acessadas por usuário autenticados)
Route::group(['middleware' => 'autenticado'], function(){

  // Rota para a exibição da view com os dados de cadastro do usuário.
  Route::get('/meu-cadastro', 'Usuario\UsuarioController@index'); //Bloqueia o acesso para usuário que não está logado

  // Rota para a exibição da view com o formulário de cadastro da ocorrência e o request de cadastramento
  Route::get('/ocorrencia/registrar', 'Ocorrencia\OcorrenciaController@create'); // Exibe o formulário somente para usuário que está logado, quem não está é redirecionado para a criação do cadastro
  Route::post('/ocorrencia/registrar', 'Ocorrencia\OcorrenciaController@store'); // Envia os dados por post somente para usuário que está logado, quem não está é redirecionado para a criação do cadastro

  // Rota para a exibição da view com os dados de uma ocorrência especifica
  Route::get('/ocorrencia/visualizar/{id}', 'Ocorrencia\OcorrenciaController@show'); // Exibe a ocorrência somente se estiver logado

  // Rota para a realização do logout do sistema.
  Route::get('/logout', 'Usuario\UsuarioController@logout'); // Permite deslogar somente o usuário que estiver logado
});

// Verifica se o usuário não está autenticado (as rotas dentro do grupo só podem ser acessadas por usuários não autenticados)
Route::group(['middleware' => 'visitante'], function(){

  Route::get('/ocorrencia', 'Ocorrencia\OcorrenciaController@index');

  // Rota para a exibição da view com o formulário de cadastro e request de cadastro
  Route::get('/registrar', 'Usuario\UsuarioController@create');  // Exibe o formulário somente para usuários que não estão logados
  Route::post('/registrar', 'Usuario\UsuarioController@store');  // Enviado os dados por post somente para usuários que não estão logados

  // Rota para a exibição da view com o formulário de login e o request de login
  Route::get('/acessar', 'Usuario\UsuarioController@login'); // Exibe o formulário somente para usuários que não estão logados
  Route::post('/acessar', 'Usuario\UsuarioController@acess'); // Realiza a autenticação somente para usuários que não estão logados
});


// ------------------------------ Área destinada ao policial ------------------------------

Route::group(['prefix' => 'policial'], function() {

  // Rota para view basica de exibição da tela com os links disponíveis para Policiais
  Route::get('/', function () {
      return view('Index/policial-index');
  });

  // Rota para a exibição da view com a lista de ocorrências e a request para busca
  Route::get('lista-ocorrencias', 'Policial\AtendimentoController@index'); // Exibe a lista de ocorrências cadastradas
  Route::post('lista-ocorrencias', 'Policial\AtendimentoController@search'); // Faz a busca no banco uma ocorrência especifica

  // Rota para a exibição da view com os dados de uma ocorrência
  Route::get('informacoes-ocorrencia/{id}', 'Policial\AtendimentoController@show');

  // Rota para a exibição da view com o formulário de atendimento da ocorrência e request de armazenamento dos dados
  Route::get('atender-ocorrencia/{id}', 'Policial\AtendimentoController@create'); // Exibe as informações da ocorrência e o formulário de atendimento
  Route::post('atender-ocorrencia', 'Policial\AtendimentoController@store'); // Enviado por post os dados de atendimento

  // Rota para a exibição da view com a lista dos usuários cadastrados e request de busca de um usuário especifico
  Route::get('lista-usuarios/', 'Policial\GerenciarUsuarioController@index'); // Exibe a lista de ocorrências
  Route::post('lista-usuarios/', 'Policial\GerenciarUsuarioController@search'); // Envia a request por post para buscar a ocorrência

  // Rota para a exibição da view com as informações do usuário
  Route::get('informacoes-usuario/{id}', 'Policial\GerenciarUsuarioController@show'); // Exibe os dados do usuário

  // Rota para chamada da função de provar usuário
  Route::get('aprovar-usuario/{id}', 'Policial\GerenciarUsuarioController@approveUser');

});

// ------------------------------ Área destinada ao Mapa do Crime ------------------------------

// Rota para exibição da tela com a seleção do tipo de mapa do crime
Route::get('/mapa', 'Localizacao\LocalizacaoController@index');
// Rota para o mapa utilizando Geolocalização
Route::get('/mapa/geolocalizacao', 'Localizacao\LocalizacaoController@showGeo');
// Rota para a exibição do mapa utilizando o formulário de endereço
Route::get('/mapa/endereco', 'Localizacao\LocalizacaoController@showEnd');
// POST com os dados do formulário de busca por endereço
Route::post('/mapa/endereco', 'Localizacao\LocalizacaoController@showEndSearch');
// GET que obtem as ocorrências de uma latitude e longitude, só pode ser acessada via AJAX
Route::get('/mapa/buscar-ocorrencias/', 'Localizacao\LocalizacaoController@searchProx');
