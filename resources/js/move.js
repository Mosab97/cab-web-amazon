var url = window.location.pathname;
var public_array = url.split("/");
var n = public_array.filter(function(value, index, arr){
            return value != "public";
        });
 window.Echo.private(`caberz-update-location.driver`)
    .listenForWhisper('moving', (e) => {
        if (n[2] == 'dashboard' && (n[n.length - 1] == 'trip' || n[n.length - 2] == 'order')) {

        if (e.lat > 1 && e.lng > 1) {
        // console.log(e);

            var bounds = new google.maps.LatLngBounds();
            var latlng = new google.maps.LatLng(e.lat, e.lng);

            if (cars.filter(x => x.driver_id == e.driver_id).length == 0) {
                var car_object = {};
                 var car = new google.maps.Marker({
                        position: new google.maps.LatLng(e.lat, e.lng),
                        icon: symbol,
                        draggable: false,
                        animation: google.maps.Animation.DROP
                    });
                    car_object['lat'] = e.lat;
                    car_object['lng'] = e.lng;
                    car_object['driver_id'] = e.driver_id;
                    car_object['speed'] = e.speed;
                    car_object['angle'] = e.angle;
                    car_object['car_marker'] = car;
                    cars.push(car_object);
                    if (e.driver_id == window.Data.driver_id &&( window.Data.order_status == 'shipped' || window.Data.order_status == 'start_trip')) {
                        car.setMap(map);
                    }else if(window.Data.order_id == null){
                        car.setMap(map);
                    }
                }

                for (var i = 0; i < cars.length; i++) {
                    if (cars[i].driver_id == e.driver_id) {
                        var icon = cars[i].car_marker.getIcon();
                        icon.rotation =  parseFloat(e.angle);
                        cars[i].car_marker.setIcon(icon)
                        cars[i].lat = e.lat;
                        cars[i].lng = e.lng;
                        cars[i].angle = e.angle;
                        cars[i].speed = e.speed;
                        if (e.driver_id == window.Data.driver_id && ( window.Data.order_status == 'shipped' || window.Data.order_status == 'start_trip')) {
                            if (map.getBounds().contains(cars[i].car_marker.getPosition())) {
                              cars[i].car_marker.setMap(map);
                            }
                            bounds.extend(cars[i].car_marker.position);
                            map.fitBounds(bounds);
                            map.setZoom(16);
                            cars[i].car_marker.animateTo(latlng,{pan:'inbounds',duration:2000});
                        }else if(window.Data.order_id == null){
                            cars[i].car_marker.animateTo(latlng,{duration:2000});
                        }
                        break;
                    }
                }
        }
    }
});
