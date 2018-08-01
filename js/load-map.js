function initMap(id,point,color,collab,color_icon,icons, theme) {
    setTimeout(function () {
        if (id == null) {
            return;
        }
        try {
            var service = new google.maps.DirectionsService;

            var styledMapType = get_theme(theme);


            var map = new google.maps.Map(document.getElementById('map'+id), {
                mapTypeControlOptions: {
                    mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                        'styled_map']
                }
            });

            map.mapTypes.set('styled_map', styledMapType);
            map.setMapTypeId('styled_map');


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
                 var icon = {
                    url: 'https://png.icons8.com/ios-glyphs/40/'+color_icon.substring(1,color_icon.length)+'/user-location.png',
                    scaledSize: new google.maps.Size(28, 28),
                 };


                if(collab==1){
                    var colorRGB = [parseInt(color.substring(1,3),16),parseInt(color.substring(3,5),16),parseInt(color.substring(5,7),16)];
                    var linecolors = [];
                    var hue = rgb2hue(colorRGB[0],colorRGB[1],colorRGB[2]);
                    var add = Math.round(100/users.length);
                    for(var i=0;i<users.length;i++) {
                        var aa = 100 - i * add;
                        linecolors.push('hsl(' + hue.toString() + ',' + aa.toString() + '%,50%)');
                    }
                }else if(collab==0){
                    var linecolors = [color];
                }
                var colorIdx = 0;
                var direction = [];


                var lngs = stations.map(function(station) { return station.lng; });
                var lats = stations.map(function(station) { return station.lat; });

                map.fitBounds({
                    west: Math.min.apply(null, lngs),
                    east: Math.max.apply(null, lngs),
                    north: Math.min.apply(null, lats),
                    south: Math.max.apply(null, lats),
                });

                for (var i = 0; i < map_points.length; i++) {

                    if(icons==1){
                        var  marker = new google.maps.Marker({
                            position: map_points[i][0],
                            icon: icon,
                            map: map
                        });
                        var content = users[i];

                        var infowindow = new google.maps.InfoWindow();

                        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
                            return function() {
                                infowindow.setContent(content);
                                infowindow.open(map,marker);
                            };
                        })(marker,content,infowindow));
                    }

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
                                        strokeColor: linecolors[colorIdx % color.length],
                                        strokeWeight: 3
                                    },
                                    map: map
                                }));
                                if(collab==1)colorIdx++;
                                if (status == google.maps.DirectionsStatus.OK) {
                                    direction[direction.length - 1].setDirections(directions);
                                }
                            }
                        );
                    }
                }
                service.route(service_options);

            }else{
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
                    renderer.setOptions({
                        suppressMarkers: true,
                        preserveViewport: true,
                        polylineOptions: {
                            strokeColor: color
                        }

                    });
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

function rgbToHsl(r, g, b) {
    r /= 255, g /= 255, b /= 255;

    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if (max == min) {
        h = s = 0;
    } else {
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }

        h /= 6;
    }

    return [ h, s, l ];
}



function hslToRgb(h, s, l) {
    var r, g, b;

    if (s == 0)
    {
        r = g = b = l;
    }
    else
    {
        function hue2rgb(p, q, t)
        {
            if (t < 0) t += 1;
            if (t > 1) t -= 1;
            if (t < 1 / 6) return p + (q - p) * 6 * t;
            if (t < 1 / 2) return q;
            if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;

        r = hue2rgb(p, q, h + 1 / 3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1 / 3);
    }

    return [
        Math.max(0, Math.min(Math.round(r * 255), 255))
        ,Math.max(0, Math.min(Math.round(g * 255), 255))
        ,Math.max(0, Math.min(Math.round(b * 255), 255))
    ];
}

function rgb2hue(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;
    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);
    var c   = max - min;
    var hue;
    if (c == 0) {
        hue = 0;
    } else {
        switch(max) {
            case r:
                var segment = (g - b) / c;
                var shift   = 0 / 60;       // R� / (360� / hex sides)
                if (segment < 0) {          // hue > 180, full rotation
                    shift = 360 / 60;         // R� / (360� / hex sides)
                }
                hue = segment + shift;
                break;
            case g:
                var segment = (b - r) / c;
                var shift   = 120 / 60;     // G� / (360� / hex sides)
                hue = segment + shift;
                break;
            case b:
                var segment = (r - g) / c;
                var shift   = 240 / 60;     // B� / (360� / hex sides)
                hue = segment + shift;
                break;
        }
    }
    return Math.round(hue * 60); // hue is in [0,6], scale it up
}
