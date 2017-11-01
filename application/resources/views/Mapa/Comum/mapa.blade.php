  <!-- Mapa -->
  <div id="map">
    <span id="lat_coord_user" class="coord-user">{{ $coord_user['lat'] }}</span>
    <span id="lng_coord_user" class="coord-user">{{ $coord_user['lng'] }}</span>
  </div>
  <div class="row">
    <!-- Botão de Voltar -->
    <div class="col s12 btn-voltar">
      <a class="btn waves-effect waves-light col s12 red" href="{{url('/mapa')}}">Voltar
        <i class="material-icons left">arrow_back</i>
      </a>
    </div>
  </div>
