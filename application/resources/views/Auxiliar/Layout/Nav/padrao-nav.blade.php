<nav class="sesp-blue" role="navigation">
  <div class="nav-wrapper container">

    <a id="logo-container" href="{{url('/')}}" class="brand-logo hide-on-med-and-down">Ocorrência Online</a>

    <a id="logo-container" href="{{url('/')}}" class="brand-logo hide-on-large-only">@yield('page-title')</a>

    <ul class="right hide-on-med-and-down">
      @if($isLogged == true)
        <li><a href="{{url('/meu-cadastro')}}">Meus dados</a></li>
        <li><a class="waves-effect waves-light btn-large red center" href="{{url('/ocorrencia/registrar')}}">REGISTRAR OCORRENCIA</a></li>
      @else
        <li><a href="{{url('/acessar')}}">Acessar Cadastro</a></li>
        <li><a href="{{url('/registrar')}}">Criar cadastro</a></li>
        <li><a class="waves-effect waves-light btn-large red center" href="{{url('/ocorrencia')}}">REGISTRAR OCORRENCIA</a></li>
      @endif
      <li><a href="{{url('/mapa')}}">Mapa do Crime</a></li>
      @if($isLogged == true)
        <li><a href="{{url('/logout')}}" class="dark-blue">Sair</a></li>
      @endif
    </ul>

    <ul id="slide-out" class="side-nav">
      @if($isLogged == true)
      <li>
        <div class="userView">
          <div class="background">
            <img src="{{asset('/assets/images/profile-bg-web.jpg')}}">
          </div>
          <a href="{{url('/meu-cadastro')}}"><img class="circle" src="{{ asset('storage/rosto/'.$usuario['foto_rosto']) }}"></a>
          <a href="{{url('/meu-cadastro')}}"><span class="white-text name">{{ $usuario['nome'] }}</span></a>
          <span class="white-text">Identidade: {{ $usuario['identidade'] }}</span>
        </div>
      </li>
      <li><a href="{{url('/')}}">Início</a></li>
      <li><a href="{{url('/meu-cadastro')}}">Minhas ocorrências</a></li>
      <li><a class="red-text" href="{{url('/ocorrencia/registrar')}}">REGISTRAR OCORRENCIA</a></li>
      <li><a href="{{url('/mapa')}}">Mapa do Crime</a></li>
      <li><a href="{{url('/logout')}}">Desconectar</a></li>
      <li><div class="divider"></div></li>
      @else
      <li>
      <li><a href="{{url('/')}}">Início</a></li>
      <li><a href="{{url('/registrar')}}">Criar cadastro</a></li>
      <li><a href="{{url('/acessar')}}">Acessar sistema</a></li>
      <li><a href="{{url('/mapa')}}">Mapa do Crime</a></li>
      <li><div class="divider"></div></li>
      @endif
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
