(function($){
  $(function(){
    $('.button-collapse').sideNav();
  }); // end of document ready
})(jQuery); // end of jQuery name space


  $(document).ready(function() {
    $('select').material_select();
  });

  $(document).ready(function(){
    $('ul.tabs').tabs();
    $("#tab-objetos-ocorrencia").click(function() {
      $('ul.tabs').tabs('select_tab', 'objetos-ocorrencia');
    });
    $("#tab-envolvidos-ocorrencia").click(function() {
      $('ul.tabs').tabs('select_tab', 'envolvidos-ocorrencia');
    });
    $("#tab-descricao-ocorrencia").click(function() {
      $('ul.tabs').tabs('select_tab', 'descricao-ocorrencia');
    });
  });

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });

  $(document).ready(function(){
  $('.modal').modal();
  });



  $('.datepicker-birthday').pickadate({
    closeOnSelect: true, // Close upon selecting a date,
    selectYears: 100,
    selectMonths: true,
    min: new Date(1900,1,1),
    max: new Date(2000,1,1),
    today: '',
    clear: 'Limpar',
    close: 'Ok',
    monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Meio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    labelMonthNext: 'Próximo mês',
    labelMonthPrev: 'Mês anterior',
    labelMonthSelect: 'Selecionar um mês',
    labelYearSelect: 'Selecionar um ano',
    format: 'd !de mmmm !de yyyy',
    formatSubmit: 'yyyy/mm/dd',
    hiddenName: true
  });

  $('.datepicker-ocorrencia').pickadate({
    closeOnSelect: true, // Close upon selecting a date,
    today: 'Hoje',
    clear: 'Limpar',
    close: 'Ok',
    monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Meio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    labelMonthNext: 'Próximo mês',
    labelMonthPrev: 'Mês anterior',
    labelMonthSelect: 'Selecionar um mês',
    labelYearSelect: 'Selecionar um ano',
    format: 'd !de mmmm !de yyyy',
    formatSubmit: 'yyyy/mm/dd',
    hiddenName: true,
    max: new Date(),
    selectYears: false,
    selectMonths: true
  });

// ------------------- Mapa do Crime ------------------- //

  // Inicialização do mapa
  function initMap() {
    // Verifica se o usuário está na página do mapa que utiliza GEOLOCALIZAÇÃO
    if(top.location.pathname === '/mapa/geolocalizacao') {
      // Caso esteja é verificado se o navegador suporte geolocalização
      if (navigator.geolocation) {
        // Se suportar é feita a oobtenção dos dados e executado a function 'positionOnMap'
        navigator.geolocation.getCurrentPosition(positionOnMap);
      } else {
        // Se não possuir é retornado um erro no console
        console.log('Não aceita geolocalizacao');
      }
    // Caso o usuário não esteja na página de GEOLOCALIZAÇÃO é feito a verificação se ele está na página de ENDEREÇO MANUAL
    } else if(top.location.pathname === '/mapa/endereco') {
      // Se estiver é feito a obtenção dos dados de coordenada dos elementos no HTML
      var lat_coord_user = Number(document.getElementById('lat_coord_user').innerText);
      var lng_coord_user = Number(document.getElementById('lng_coord_user').innerText);
      // É criado um array COORDS com os dados de latitude e longitudo
      var coords = {
        latitude: lat_coord_user,
        longitude: lng_coord_user
      }
      // O Array anterior é posto dentro do array POSITION. Este processo é apenas para facilitar no positionOnMap, pois o navegador retorna os dados dessa maneira
      var position = {
        coords
      };
      // Após preencher o array é chamado a function positionOnMap
      positionOnMap(position);
    }
  }

  // Cria o mapa, insere o marcador do usuário e chama a function que busca ocorrência nas proximidades
  function positionOnMap(position) {
    // Cria uma nova variavel position com os dados no formato que o Google Maps aceita
    var position = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };
    // Cria o mapa
    var map = mapCreate(position);
    // Define qual será o ícone de marker do usuário
    var image = {
      url: '../assets/images/usuario-marker.png',
      size: new google.maps.Size(30, 30),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(30, 30)
    };

    // Gera o marcador da posição recebida
    var marker = new google.maps.Marker({
      position: position,
      map: map,
      icon: image,
      title: 'Seu local'
    });

    // Chama a função que irá buscar as ocorrências próximo as coordenadas e adiciona no mapa
    searchOcorrencias(position.lat, position.lng, map);
  }

  // Cria o mapa com as definições de estilo
  function mapCreate(position) {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: position,
      styles: [
        {
          "featureType": "water",
          "stylers": [
            {
              "saturation": 43
            },
            {
              "lightness": -11
            },
            {
              "hue": "#0088ff"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "geometry.fill",
          "stylers": [
            {
              "hue": "#ff0000"
            },
            {
              "saturation": -100
            },
            {
              "lightness": 99
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "geometry.stroke",
          "stylers": [
            {
              "color": "#808080"
            },
            {
              "lightness": 54
            }
          ]
        },
        {
          "featureType": "landscape.man_made",
          "elementType": "geometry.fill",
          "stylers": [
            {
              "color": "#ece2d9"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry.fill",
          "stylers": [
            {
              "color": "#ccdca1"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#767676"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.stroke",
          "stylers": [
            {
              "color": "#ffffff"
            }
          ]
        },
        {
          "featureType": "poi",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "landscape.natural",
          "elementType": "geometry.fill",
          "stylers": [
            {
              "visibility": "on"
            },
            {
              "color": "#b8cb93"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "stylers": [
            {
              "visibility": "on"
            }
          ]
        },
        {
          "featureType": "poi.sports_complex",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi.medical",
          "stylers": [
            {
              "visibility": "on"
            }
          ]
        },
        {
          "featureType": "poi.business",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        }
      ]
    });
    return map;
  }


  // Função que busca executa um GET para obter todas as ocorrências próximas a uma latitude e longitude.
  function searchOcorrencias(lat_coord_user, lng_coord_user, map) {
    $.ajax({
      method: 'GET',                      // Método de obtenção dos dados
      url: '/mapa/buscar-ocorrencias',    // URL que será acessada. A function ligada a essa rota aceita SOMENTE acesso via AJAX
      data: {
        'lat' : lat_coord_user,           // Coordenadas de Latitude
        'lng' : lng_coord_user            // Coordenadas de Longitude
      },
      // Caso a request obtenha sucesso
      success: function(response){
        // Cria um marcado como nulo
        var marker = null;
        // Cria uma janela de informação
        var infowindow = new google.maps.InfoWindow();
        // Cria um bound de latitude de longitude
        var bounds = new google.maps.LatLngBounds();
        // Para cada ocorrencia encontrada é feito o foreach
        for (var i = 0; i < response['ocorrencias'].length; i++) {
          // Cria uma ocorrência com os dados da ocorrência acessada no momento
          ocorrencia = response['ocorrencias'][i];
          // Cria uma variável com a posição das as coordenadas da ocorrência
          var myLatlngMarker = new google.maps.LatLng(ocorrencia['latitude'], ocorrencia['longitude']);
          // Cria o marker com os dados da ocorrência

          var image = {
            url: '../assets/images/crime-marker.png',
            size: new google.maps.Size(30, 30),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(30, 30)
          };

          var marker = new google.maps.Marker({
            position: myLatlngMarker,
            map: map,
            title: ocorrencia['tipo'],
            info: '<div id="content">'+
               '<div id="siteNotice">'+
               '</div>'+
               '<h5 id="firstHeading" class="firstHeading">'+ ocorrencia['tipo'] + '</h5>'+
               '<div id="bodyContent">'+
               '<p><b>Data:</b> '+ ocorrencia['data'] +'</p>'+
               '<p><b>Endereço:</b> '+ ocorrencia['endereco'] +'</p>'+
               '</div>'+
               '</div>',
             icon: image,
          });
          // Adiciona o evento de "escuta" para o marker
          google.maps.event.addListener(marker, 'click', function () {

              infowindow.setContent(this.info);
              infowindow.open(map, this);
          });

          bounds.extend(myLatlngMarker);
        }
      },
      error: function(response) {
          console.log("Erro ao obter dados das ocorrências");
      }
    });
  }

// ----------- Mascara de campo -----------

$(document).ready(function(){
  $('.cep').mask('00000-000');
  $('.phone_with_ddd').mask('(00) 00000-0000');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.identidade').mask('0.000.000', {reverse: true});
});

$("#cadastro-usuario-form").submit(function() {
  $('.cep').unmask();
  $('.phone_with_ddd').unmask();
  $('.cpf').unmask();
  $('.identidade').unmask();
});

$("#login-form").submit(function() {
  $('.identidade').unmask();
});

$("#ocorrencia-form").submit(function() {
  $('.cep').unmask();
  $('.phone_with_ddd').unmask();
  $('.cpf').unmask();
  $('.identidade').unmask();
});
