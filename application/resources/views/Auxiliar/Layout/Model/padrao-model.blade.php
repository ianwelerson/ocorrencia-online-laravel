@include('Auxiliar/Layout/Header/padrao-header')

  @include('Auxiliar/Layout/Nav/padrao-nav')

  <div class="section no-pad-bot height-screen">
      <div class="container placeholder-font-color">

          <h1 class="thin center-align hide-on-med-and-down">@yield('page-title')</h1>

          @if(session()->has('mensagem_erro'))
          <p class="alert-msg">
            {{ session()->get('mensagem_erro') }}
          </p>
          @endif
          @if(session()->has('mensagem_sucesso'))
          <p class="success-msg">
            {{ session()->get('mensagem_sucesso') }}
          </p>
          @endif

      @yield('content')

    </div>
  </div>

@include('Auxiliar/Layout/Footer/padrao-footer')
