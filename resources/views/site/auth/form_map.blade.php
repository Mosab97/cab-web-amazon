
<script>
    var lati = 24.279784;
    var lngi = 43.753295;
    
    function initMap() {
        var myLatlng = new google.maps.LatLng(lati, lngi);
        var map;
        var myOptions = {
            zoom: 12,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map"), myOptions);
        // marker refers to a global variable
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable: true
        });
        // Create the search box and link it to the UI element.
        var input = document.getElementById('searchBox');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                // marker refers to a global variable
                marker.setPosition(place.geometry.location);
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                document.getElementById("lat").value = place.geometry.location.lat();
                document.getElementById("lng").value = place.geometry.location.lng();
            });
            map.fitBounds(bounds);
        });
        google.maps.event.addListener(marker, "dragend", function(event) {
            // get lat/lon of click
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();
            // show in input box
            document.getElementById("lat").value = clickLat.toFixed(5);
            document.getElementById("lng").value = clickLon.toFixed(5);
        });

        google.maps.event.addListener(marker, 'position_changed', function() {

            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#searchBox').val(marker.getPosition().title);
            $('#lat').val(lat);
            $('#lng').val(lng);
            displayLocation(lat, lng);
        });
    }

    function displayLocation(latitude, longitude) {
        var request = new XMLHttpRequest();
        var method = 'GET';
        var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latitude + ',' + longitude + "&key={{ setting('map_api') }}&sensor=false&language=ar";
        var async = true;
        request.open(method, url, async);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var data = JSON.parse(request.responseText);
                var address = data.results[0];
                $('#searchBox').val(address.formatted_address);
            }
        };
        request.send();
    };
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key={{ setting('map_api') }}&libraries=places&language=ar&callback=initMap" async defer></script>
