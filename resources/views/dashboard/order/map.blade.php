<script>
var bearing = 0;
   function initMap() {
       var start_location = '<div style="width:270px; height:100px;" class="infowindow">'+
                       '<img src="{{ $order->client->avatar }}" alt="" style="width:50px; height:50px; float:left;"/>'+
                       '<h4 class="text-primary text-small-1"> <i class="feather icon-user float-left mr-1"></i> : {{ $order->client->fullname }}</h4>'+
                       '<h4 class="text-primary text-small-1"><a href="mailto:{{ $order->client->email }}"> <i class="feather icon-mail float-left mr-1"></i> : {{ $order->client->email }}</a></h4>'+
                       '<h4 class="text-primary text-small-3"><a href="tel:{{ $order->client->phone }}"><i class="feather icon-phone float-left mr-1"></i> : {{ $order->client->phone }}</a></h4></div>';

       var end_location = '<div style="width:270px; height:100px;" class="infowindow text-primary">'+
                       '<img src="{{ optional($order->driver)->avatar }}" alt="" style="width:50px; height:50px; float:left;"/>'+
                       '<h4 class="text-primary text-small-1"> <i class="feather icon-target float-left mr-1"></i> : {{ optional($order->driver)->fullname }}</h4>'+
                       '<h4 class="text-primary text-small-3"><i class="feather icon-phone float-left mr-1"></i> : {{ optional($order->driver)->phone }}</a></h4>'+
                       '<h4 class="text-primary text-small-1"><i class="feather icon-mail float-left mr-1"></i> : {{ optional($order->driver)->email }}</a></h4></div>';
       var locations = [
           [{{ $order->start_lat }}, {{ $order->start_lng }}, start_location],
           [{{ $order->end_lat }}, {{ $order->end_lng }}, end_location]
       ];
       var infowindow = new google.maps.InfoWindow();

       var bounds = new google.maps.LatLngBounds();

       window.map = new google.maps.Map(document.getElementById('map'), {
           mapTypeId: google.maps.MapTypeId.ROADMAP,
           zoom: 10,
           // draggable:false
       });

       const flightPlanCoordinates = @json($order->expected_route);
       const flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
          });
      flightPath.setMap(map);


       window.symbol = {
           path: "M62.1,36.5c-0.9-1.2-3.6-1.5-3.6-1.5c0.1-3.5,0.5-6.9,0.7-8.2c1.9-7.3-1.7-11.8-1.7-11.8c-4.8-4.8-9.1-5-12.5-5   c-3.4,0-7.8,0.3-12.5,5c0,0-3.6,4.5-1.7,11.8c0.2,1.2,0.5,4.6,0.7,8.2c0,0-2.7,0.3-3.6,1.5c-0.9,1.2-0.9,1.9,0,1.9   c0.9,0,2.9-2.3,3.6-2.3V35c0,1,0.1,2,0.1,3c0,4.4,0,33.7,0,33.7s-0.3,6.1,5,7.8c1.2,0,4.6,0.4,8.4,0.5c3.8-0.1,7.3-0.5,8.4-0.5   c5.3-1.7,5-7.8,5-7.8s0-29.3,0-33.7c0-1,0-2,0.1-3v1.2c0.7,0,2.7,2.3,3.6,2.3C63,38.5,63,37.7,62.1,36.5z M34.7,66.5   c-0.3,3.3-2.3,4.1-2.3,4.1V37.4c0.8,1.2,2.3,6.8,2.3,6.8S34.9,63.2,34.7,66.5z M54.8,75.2c0,0-4.2,2.3-9.8,2.2   c-5.6,0.1-9.8-2.2-9.8-2.2v-2.8c4.9,2.2,9.8,2.2,9.8,2.2s4.9,0,9.8-2.2V75.2z M35.2,41.1l-1.7-10.2c0,0,4.5-3.2,11.5-3.2   s11.5,3.2,11.5,3.2l-1.7,10.2C51.4,39.2,38.6,39.2,35.2,41.1z M57.7,70.6c0,0-2.1-0.8-2.3-4.1c-0.3-3.3,0-22.4,0-22.4   s1.5-5.6,2.3-6.8V70.6z",
           fillColor: '#298991',
           fillOpacity: 1,
           anchor: new google.maps.Point(40 , 40),
           strokeWeight: 1,
           scale: .5,
           rotation: bearing
       }

       google.maps.Marker.prototype.animateTo = function (newPosition, options) {
           defaultOptions = {
               duration: 1000,
               easing: 'linear',
               complete: null,
               pan: null
           }
           options = options || {};

           // complete missing options
           for (key in defaultOptions) {
               options[key] = options[key] || defaultOptions[key];
           }

           // throw exception if easing function doesn't exist
           if (options.easing != 'linear') {
               if (typeof jQuery == 'undefined' || !jQuery.easing[options.easing]) {
                   throw '"' + options.easing + '" easing function doesn\'t exist. Include jQuery and/or the jQuery easing plugin and use the right function name.';
                   return;
               }
           }

           // make sure the pan option is valid
           if (options.pan !== null) {
               if (options.pan !== 'center' && options.pan !== 'inbounds') {
                   return;
               }
           }

           window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
           window.cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

           // save current position. prefixed to avoid name collisions. separate for lat/lng to avoid calling lat()/lng() in every frame
           this.AT_startPosition_lat = this.getPosition().lat();
           this.AT_startPosition_lng = this.getPosition().lng();
           var newPosition_lat = newPosition.lat();
           var newPosition_lng = newPosition.lng();
           var newPoint = new google.maps.LatLng(newPosition.lat(), newPosition.lng());

           if (options.pan === 'center') {
               window.map.setCenter(newPoint);
           }

           if (options.pan === 'inbounds') {
               if (!window.map.getBounds().contains(newPoint)) {
                   var mapbounds = window.map.getBounds();
                   mapbounds.extend(newPoint);
                   window.map.fitBounds(mapbounds);
               }
           }

           // crossing the 180° meridian and going the long way around the earth?
           if (Math.abs(newPosition_lng - this.AT_startPosition_lng) > 180) {
               if (newPosition_lng > this.AT_startPosition_lng) {
                   newPosition_lng -= 360;
               } else {
                   newPosition_lng += 360;
               }
           }

           var animateStep = function(marker, startTime) {
               var ellapsedTime = (new Date()).getTime() - startTime;
               var durationRatio = ellapsedTime / options.duration; // 0 - 1
               var easingDurationRatio = durationRatio;

               // use jQuery easing if it's not linear
               if (options.easing !== 'linear') {
                   easingDurationRatio = jQuery.easing[options.easing](durationRatio, ellapsedTime, 0, 1, options.duration);
               }

               if (durationRatio < 1) {
                   var deltaPosition = new google.maps.LatLng(marker.AT_startPosition_lat + (newPosition_lat - marker.AT_startPosition_lat) * easingDurationRatio,
                       marker.AT_startPosition_lng + (newPosition_lng - marker.AT_startPosition_lng) * easingDurationRatio);
                   marker.setPosition(deltaPosition);

                   // use requestAnimationFrame if it exists on this browser. If not, use setTimeout with ~60 fps
                   if (window.requestAnimationFrame) {
                       marker.AT_animationHandler = window.requestAnimationFrame(function() {
                           animateStep(marker, startTime)
                       });
                   } else {
                       marker.AT_animationHandler = setTimeout(function() {
                           animateStep(marker, startTime)
                       }, 17);
                   }

               } else {

                   marker.setPosition(newPosition);

                   if (typeof options.complete === 'function') {
                       options.complete();
                   }

               }
           }

           // stop possibly running animation
           if (window.cancelAnimationFrame) {
               window.cancelAnimationFrame(this.AT_animationHandler);
           } else {
               clearTimeout(this.AT_animationHandler);
           }

           animateStep(this, (new Date()).getTime());
       }



        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                map: map
            });

            bounds.extend(marker.position);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][2]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        map.fitBounds(bounds);

        var listener = google.maps.event.addListener(map, "idle", function() {
            map.setZoom(15);
            google.maps.event.removeListener(listener);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key={{ setting('map_api') }}&sensor=false&libraries=places&language=ar&callback=initMap" async defer></script>
