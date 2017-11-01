<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- MateriazeCSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">

    <link rel="manifest" href="/manifest.json">

    <!-- Icone -->
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}"/>

    <title>@yield('navegador-title')</title>

  </head>
  <body>
    <nav class="sesp-blue" role="navigation">
      <div class="nav-wrapper container">

        <a id="logo-container" href="{{url('/policial')}}" class="brand-logo hide-on-med-and-down">Delegacia Online</a>

        <a id="logo-container" href="{{url('/policial')}}" class="brand-logo hide-on-large-only">@yield('page-title')</a>

        <ul class="right hide-on-med-and-down">
          <li><a href="{{url('/policial')}}">Página inicial</a></li>
          <li><a href="{{url('/policial/lista-usuarios')}}">Lista de Usuários</a></li>
          <li><a href="{{url('/policial/lista-ocorrencias')}}">Lista de Ocorrências</a></li>
        </ul>

        <ul id="slide-out" class="side-nav">
          <li><a href="{{url('/policial')}}">Página inicial</a></li>
          <li><a href="{{url('/policial/lista-usuarios')}}">Lista de Usuários</a></li>
          <li><a href="{{url('/policial/lista-ocorrencias')}}">Lista de Ocorrências</a></li>
          <li><div class="divider"></div></li>

        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>
