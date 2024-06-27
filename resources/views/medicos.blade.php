@extends('welcome')

@section('content')
    <div class="container">
        <h1>Buscar Centros Médicos</h1>

        <div class="row">
            <div class="col-md-6">
                <form id="filter-form" onsubmit="searchDoctors(); return false;">
                    <div class="form-group">
                        <label for="filtro_especialidad">Filtrar por Especialidad:</label>
                        <select name="filtro_especialidad" id="filtro_especialidad" class="form-control">
                            <option value="">Todas las Especialidades</option>
                            <option value="cardiologist">Cardiología</option>
                            <option value="dermatologist">Dermatología</option>
                            <option value="gynecologist">Ginecología</option>
                            <option value="pediatrician">Pediatría</option>
                            <option value="neurologist">Neurología</option>
                            <option value="orthopedist">Ortopedia</option>
                            <option value="psychiatrist">Psiquiatría</option>
                            <option value="ophthalmologist">Oftalmología</option>
                            <option value="urologist">Urología</option>
                            <option value="endocrinologist">Endocrinología</option>
                            <option value="gastroenterologist">Gastroenterología</option>
                            <option value="rheumatologist">Reumatología</option>
                            <option value="pulmonologist">Neumología</option>
                            <option value="oncologist">Oncología</option>
                            <option value="allergist">Alergología</option>
                            <option value="nephrologist">Nefrología</option>
                            <!-- Agrega más opciones de especialidades aquí -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div id="map" style="height: 500px; width: 100%;"></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div id="no-results" style="display: none;" class="alert alert-warning">
                    No hay resultados para la búsqueda.
                </div>
            </div>
        </div>
    </div>

    <script>
        let map;
        let infowindow;
        let markers = [];

        async function initMap() {
            var defaultLocation = { lat: 40.416775, lng: -3.703790 };

            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 12
            });

            infowindow = new google.maps.InfoWindow();

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map.setCenter(userLocation);
                    searchDoctors(userLocation);
                }, function() {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                handleLocationError(false, map.getCenter());
            }

            map.addListener('click', function(event) {
                map.setCenter(event.latLng);
                searchDoctors(event.latLng);
            });
        }

        function searchDoctors(location) {
            let userLocation = location || map.getCenter();
            let specialty = document.getElementById('filtro_especialidad').value;

            let request = {
                location: userLocation,
                radius: 5000,
                keyword: specialty || 'health'
            };

            let service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, function(results, status) {
                clearMarkers();
                if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i]);
                    }
                    document.getElementById('no-results').style.display = 'none';
                } else {
                    document.getElementById('no-results').style.display = 'block';
                }
            });
        }

        function createMarker(place) {
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });

            markers.push(marker);

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent('<div style="color: black;"><strong>' + place.name + '</strong><br>' +
                    'Dirección: ' + place.vicinity + '<br>' +
                    'Rating: ' + (place.rating || 'No disponible') + '<br>' +
                    '<button onclick="getDetails(\'' + place.place_id + '\')">Ver detalles</button></div>');
                infowindow.open(map, this);
            });
        }

        window.getDetails = function(placeId) {
            var service = new google.maps.places.PlacesService(map);
            service.getDetails({ placeId: placeId }, function(place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    infowindow.setContent('<div style="color: black;"><strong>' + place.name + '</strong><br>' +
                        'Dirección: ' + place.formatted_address + '<br>' +
                        'Teléfono: ' + (place.formatted_phone_number || 'No disponible') + '<br>' +
                        'Horario: ' + (place.opening_hours ? place.opening_hours.weekday_text.join('<br>') : 'No disponible') + '<br>' +
                        '<a href="' + place.url + '" target="_blank">Ver en Google Maps</a></div>');
                    infowindow.open(map);
                }
            });
        }

        function handleLocationError(browserHasGeolocation, pos) {
            infowindow.setPosition(pos);
            infowindow.setContent(browserHasGeolocation ?
                'Error: El servicio de geolocalización falló.' :
                'Error: Tu navegador no soporta geolocalización.');
            infowindow.open(map);
        }

        function clearMarkers() {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }
    </script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCub_5Fkr2U92yYBckDqsusykToTGg84TU&libraries=places&callback=initMap">
</script>

@endsection
