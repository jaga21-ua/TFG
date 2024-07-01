@extends('welcome')

@section('content')
<div class="container">
    <h2>Farmacias Cercanas</h2>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="openNow" onclick="searchPharmacies()">
        <label class="form-check-label" for="openNow">Mostrar solo farmacias abiertas ahora</label>
    </div>
    <div id="map" style="height: 500px; width: 100%;"></div>
</div>

<script>
    let map;
    let infowindow;

    function initMap() {
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
                searchPharmacies(userLocation);
            }, function() {
                handleLocationError(true, map.getCenter());
            });
        } else {
            handleLocationError(false, map.getCenter());
        }
        map.addListener('click', function(event) {
            map.setCenter(event.latLng);
            searchPharmacies(event.latLng);
        });
    }
    function searchPharmacies(location) {
        let userLocation = location || map.getCenter();
        let openNow = document.getElementById('openNow').checked;

        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
            location: userLocation,
            radius: 5000,
            type: ['pharmacy'],
            openNow: openNow
        }, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                clearMarkers();
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        });
    }

    function createMarker(place) {
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });

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
        var markers = map.markers || [];
        markers.forEach(marker => marker.setMap(null));
        map.markers = [];
    }

    document.getElementById('openNow').addEventListener('change', function() {
        searchPharmacies();
    });
</script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('Maps_key')}}&libraries=places&callback=initMap">
    </script>
@endsection
