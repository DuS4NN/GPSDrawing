function initMap(id,point) {

    setTimeout(function () {
        if (id == null) {
            return;
        }
        try {
            var service = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map' + id),{
                zoom: 0,
                center: {
                    lat: 28.6247,
                    lng: 77.3731
                },
                disableDefaultUI: true,
            });
            // list of points

            if (point.includes("*")) {
                var array = point.split("*");
                var count = 0;
                var users = new Array();
                var points = new Array();

                var stations = new Array();

                for (var i = 0; i < array.length; i += 2) {
                    users[count] = array[i];
                    points[count] = array[i + 1];
                    count++;
                }

                var map_points = [];
                var count2=0;
                for (var i = 0; i < points.length; i++) {
                    map_points[i] = [];
                    var array = points[i].split(";");
                    var count = 0;
                    for (var j = 0; j < array.length; j = j + 2) {
                        map_points[i][count] = {
                            lat: parseFloat(array[j]),
                            lng: parseFloat(array[j + 1]),
                            name: 'Station'
                        };
                        stations[count2]={
                            lat: parseFloat(array[j]),
                            lng: parseFloat(array[j + 1]),
                            name: 'Station'
                        };
                        count++;
                        count2++;
                    }
                }

                var linecolors = ['red', 'blue', 'green', 'yellow'];
                var direction = [];
                var colorIdx = 0;

                var lngs = stations.map(function(station) { return station.lng; });
                var lats = stations.map(function(station) { return station.lat; });

                map.fitBounds({
                    west: Math.min.apply(null, lngs),
                    east: Math.max.apply(null, lngs),
                    north: Math.min.apply(null, lats),
                    south: Math.max.apply(null, lats),
                });


                for (var i = 0; i < map_points.length; i++) {

                    for (var j = 0, parts = [], max = 8 - 1; j < map_points[i].length; j = j + max) {
                        parts.push(map_points[i].slice(j, j + max + 1));
                    }

                    for (var j = 0; j < parts.length; j++) {
                        // Waypoints does not include first station (origin) and last station (destination)
                        var waypoints = [];
                        for (var k = 1; k < parts[j].length - 1; k++)
                            waypoints.push({location: parts[j][k], stopover: false});
                        // Service options
                        var service_options = {
                            origin: parts[j][0],
                            destination: parts[j][parts[j].length - 1],
                            waypoints: waypoints,
                            travelMode: 'WALKING'
                        };

                        // Send request
                        service.route(service_options,
                            function(directions, status) {
                                direction.push(new google.maps.DirectionsRenderer({
                                    suppressInfoWindows: true,
                                    suppressMarkers: true,
                                    preserveViewport: true,
                                    polylineOptions: {
                                        strokeColor: linecolors[colorIdx++ % 3]
                                    },
                                    map: map
                                }));

                                if (status == google.maps.DirectionsStatus.OK) {
                                    direction[direction.length - 1].setDirections(directions);
                                }
                            }
                        );
                    }
                }

                service.route(service_options);


            }else{
                var service = new google.maps.DirectionsService;
                var map = new google.maps.Map(document.getElementById('map'+id));
                // list of points

                var points = point.split(";");

                var stations = new Array();
                var num=0;
                for(var i=0; i<points.length;i+=2){
                    stations[num] = {lat: parseFloat(points[i]), lng: parseFloat(points[i+1]), name: 'Station'};
                    num++;
                }

                // Zoom and center map automatically by stations (each station will be in visible map area)
                var lngs = stations.map(function(station) { return station.lng; });
                var lats = stations.map(function(station) { return station.lat; });
                map.fitBounds({
                    west: Math.min.apply(null, lngs),
                    east: Math.max.apply(null, lngs),
                    north: Math.min.apply(null, lats),
                    south: Math.max.apply(null, lats),
                });


                // Divide route to several parts because max stations limit is 25 (23 waypoints + 1 origin + 1 destination)
                for (var i = 0, parts = [], max = 8 - 1; i < stations.length; i = i + max)
                    parts.push(stations.slice(i, i + max + 1));

                // Callback function to process service results
                var service_callback = function(response, status) {
                    if (status != 'OK') {
                        console.log('Directions request failed due to ' + status);
                        return;
                    }
                    var renderer = new google.maps.DirectionsRenderer;
                    renderer.setMap(map);
                    renderer.setOptions({ suppressMarkers: true, preserveViewport: true });
                    renderer.setDirections(response);
                };

                // Send requests to service to get route (for stations count <= 25 only one request will be sent)
                for (var i = 0; i < parts.length; i++) {
                    // Waypoints does not include first station (origin) and last station (destination)
                    var waypoints = [];
                    for (var j = 1; j < parts[i].length - 1; j++)
                        waypoints.push({location: parts[i][j], stopover: false});
                    // Service options
                    var service_options = {
                        origin: parts[i][0],
                        destination: parts[i][parts[i].length - 1],
                        waypoints: waypoints,
                        travelMode: 'WALKING'
                    };
                    // Send request
                    service.route(service_options, service_callback);
                }
            }

        } catch (e) {
            initMap(id, point);
        }
    }, 250);


}
