<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="robots" content="noindex, nofollow" />
    <meta
      name="viewport"
      content="initial-scale=1,maximum-scale=1,user-scalable=no"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
    />
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js"></script>
    <link
      href="https://api.tiles.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
      }
      .marker {
        background-image: url('images/mapbox-icon.png');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
      }
      .mapboxgl-popup {
        max-width: 200px;
      }
      .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
      }
    </style>
  </head>
  <body>
	  <!-- AQUI ES DONDE SALE EL MAPA DENTRO DEL CONTENEDOR CON ID map -->
    <div id="map"></div>
	<!-- seccion de scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
		/* ESTA LLAVE LA GENERE YO PERO PUEDES GENERAR LA TUYA EN MAPBOX.COM */
      	mapboxgl.accessToken = 'pk.eyJ1IjoibHVpc21pbHV1IiwiYSI6ImNrYTVndThmZDAxenozZW1tcXJrc2dyZzcifQ.pJxupV3enZdx-wQfP8SSBQ';

		//Con esto mandamos traer la informacion del mapa en formato
		//JSON desde la bdd mysql
	  	var jsonData= $.ajax({
						url: 'chart.php',
						//data: {'periodo':periodo,'action':'ajax'},
						dataType: 'json',
						async: false
					}).responseText;

		var obj = jQuery.parseJSON(jsonData);
		
		var geojson =obj;

      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: [ -106.072003,28.636200],
        zoom: 11
      });

      // add markers to map
      geojson.features.forEach(function(marker) {
        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(
            new mapboxgl.Popup({ offset: 25 }) // add popups
              .setHTML(
                '<h3>' +
                  marker.properties.title +
                  '</h3><p>' +
                  marker.properties.description +
                  '</p>'
              )
          )
          .addTo(map);
      });
    </script>
  </body>
</html>