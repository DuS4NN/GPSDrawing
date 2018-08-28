window.initMap = function (id,point,color,collab,color_icon,icons, theme,travelmode) {
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

            if(point.includes("*")){
                const array = point.split("*");
                const map_points = [];
                const stations = [];
                const users = [];
                const points = [];

                for(let i = 0; i<array.length;i+=2){
                    users.push(array[i]);
                    points.push(array[i+1]);
                }

                let count = 0;

                for(let i = 0; i<points.length;i++){
                    map_points[i] = [];
                    let points_split = points[i].split(";");
                    for(let j = 0; j < points_split.length; j+=2){
                        map_points[i][j/2] = {
                          lat: parseFloat(points_split[j]),
                          lng: parseFloat(points_split[j+1]),
                          name: 'Station'
                        };
                        stations[count] = {
                            lat: parseFloat(points_split[j]),
                            lng: parseFloat(points_split[j+1]),
                            name: 'Station'
                        };
                        count++;
                    }
                }

                const icon = {
                    url: 'https://png.icons8.com/ios-glyphs/40/'+color_icon.substring(1,color_icon.length)+'/user-location.png',
                    scaledSize: new google.maps.Size(28,28)
                };

                const line_colors = [];
                const direction = [];
                let colorIdx = 0;



                if(collab==1){
                    let color_RGB = [parseInt(color.substring(1,3),16),parseInt(color.substring(3,5),16),parseInt(color.substring(5,7),16)];
                    let hue = rgb2hue(color_RGB[0],color_RGB[1],color_RGB[2]);
                    let add = Math.round(100/users.length);

                    for(let i=0; i<users.length;i++){
                        let saturation = 100 - i*add;
                        line_colors.push('hsl('+hue.toString()+','+saturation.toString()+'%,50%)');
                    }
                }else if(collab==0){
                    line_colors.push(color);
                }



                let lngs = stations.map(function(station) { return station.lng; });
                let lats = stations.map(function(station) { return station.lat; });

                map.fitBounds({
                    west: Math.min.apply(null, lngs),
                    east: Math.max.apply(null, lngs),
                    north: Math.min.apply(null, lats),
                    south: Math.max.apply(null, lats),
                });

                let count_dis = 0;
                let count_time = 0;

                for (let i=0; i<map_points.length; i++) {

                    if (icons == 1) {
                        let marker = new google.maps.Marker({
                            position: map_points[i][0],
                            icon: icon,
                            map: map
                        });

                        let content = users[i];
                        let info_window = new google.maps.InfoWindow();

                        google.maps.event.addListener(marker, 'click', (function (marker, content, info_window) {
                            return function () {
                                info_window.setContent(content);
                                info_window.open(map, marker);
                            };
                        })(marker, content, info_window));
                    }

                    const parts = [];

                    for (let j = 0, max = 25 - 1; j < map_points[i].length; j = j + max) {
                        parts.push(map_points[i].slice(j, j + max + 1));
                    }

                    let travel = 'WALKING';
                    switch (travelmode){
                        case "0":
                            travel = 'WALKING';
                            break;
                        case "1":
                            travel = 'WALKING';
                            break;
                        case "2":
                            travel = 'DRIVING';
                            break;
                        case "3":
                            travel = 'DRIVING';
                            break;
                    }

                    for (let j = 0; j < parts.length; j++) {
                        // Waypoints does not include first station (origin) and last station (destination)
                        let waypoints = [];
                        for (let k = 1; k < parts[j].length - 1; k++)
                            waypoints.push({location: parts[j][k], stopover: false});
                        // Service options
                        let service_options = {
                            origin: parts[j][0],
                            destination: parts[j][parts[j].length - 1],
                            waypoints: waypoints,
                            travelMode: travel
                        };


                        service.route(service_options,
                            function(response, status) {
                                direction.push(new google.maps.DirectionsRenderer({
                                    suppressInfoWindows: true,
                                    suppressMarkers: true,
                                    preserveViewport: true,
                                    polylineOptions: {
                                        strokeColor: line_colors[colorIdx % color.length],
                                        strokeWeight: 3
                                    },
                                    map: map
                                }));


                                if(collab==1)colorIdx++;
                                if (status !== 'OK') {
                                    console.log('Directions request failed due to ' + status);
                                    return;
                                }


                                let num_time = parseFloat(response.routes[0].legs[0].duration.value);
                                count_time += num_time;

                                if(count_time<=60){
                                    document.getElementById("post-footer-duration-"+id).innerText = count_time+" s";
                                }else if(count_time>60 && count_time<3600){
                                    document.getElementById("post-footer-duration-"+id).innerText = parseInt(count_time/60)+" min";
                                }else{
                                    document.getElementById("post-footer-duration-"+id).innerText = parseInt(count_time/60/60)+" h"+" "+parseInt(count_time/60%60)+" min";
                                }

                                let num_distance = parseFloat(response.routes[0].legs[0].distance.value);
                                count_dis += num_distance;
                                document.getElementById("post-footer-distance-"+id).innerText = Math.round((count_dis/1000) * 10) / 10+" km";


                                direction[direction.length - 1].setDirections(response);

                            }
                        );
                    }

                }

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
                for (var i = 0, parts = [], max = 25 - 1; i < stations.length; i = i + max)
                    parts.push(stations.slice(i, i + max + 1));


                var count_dis = 0;
                var count_time = 0;
                // Callback function to process service results
                var service_callback = function(response, status) {
                        if (status !== 'OK') {
                            console.log('Directions request failed due to ' + status);
                            return;
                        }


                        let num_time = parseFloat(response.routes[0].legs[0].duration.value);
                        count_time += num_time;

                        if(count_time<=60){
                            document.getElementById("post-footer-duration-"+id).innerText = count_time+" s";
                        }else if(count_time>60 && count_time<3600){
                            document.getElementById("post-footer-duration-"+id).innerText = parseInt(count_time/60)+" min";
                        }else{
                            document.getElementById("post-footer-duration-"+id).innerText = parseInt(count_time/60/60)+" h"+" "+parseInt(count_time/60%60)+" min";
                        }

                        let num_distance = parseFloat(response.routes[0].legs[0].distance.value);
                        count_dis += num_distance;
                        document.getElementById("post-footer-distance-"+id).innerText = Math.round((count_dis/1000) * 10) / 10+" km";


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

                    var travel = 'WALKING';
                    switch (travelmode){
                        case "0":
                            travel = 'WALKING';
                            break;
                        case "1":
                            travel = 'WALKING';
                            break;
                        case "2":
                            travel = 'DRIVING';
                            break;
                        case "3":
                            travel = 'DRIVING';
                            break;
                    }

                    var waypoints = [];
                    for (var j = 1; j < parts[i].length - 1; j++)
                        waypoints.push({location: parts[i][j], stopover: false});
                    // Service options
                    var service_options = {
                        origin: parts[i][0],
                        destination: parts[i][parts[i].length - 1],
                        waypoints: waypoints,
                        travelMode: travel
                    };
                    // Send request
                     service.route(service_options, service_callback);
                }


            }
        } catch (e) {
            console.log("Error with init map: "+e);
           // initMap(id,point,color,collab,color_icon,icons, theme,travelmode);
        }
    }, 550);
};

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
                var shift   = 0 / 60;       // R° / (360° / hex sides)
                if (segment < 0) {          // hue > 180, full rotation
                    shift = 360 / 60;         // R° / (360° / hex sides)
                }
                hue = segment + shift;
                break;
            case g:
                var segment = (b - r) / c;
                var shift   = 120 / 60;     // G° / (360° / hex sides)
                hue = segment + shift;
                break;
            case b:
                var segment = (r - g) / c;
                var shift   = 240 / 60;     // B° / (360° / hex sides)
                hue = segment + shift;
                break;
        }
    }
    return Math.round(hue * 60); // hue is in [0,6], scale it up
}


function initMap2(id) {
    var styledMapType = get_theme(id);


    var map = new google.maps.Map(document.getElementById('settings-map'+id), {
        mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                'styled_map']
        },
        disableDefaultUI: true,
        center: {lat: -34.397, lng: 150.644},
        zoom: 8

    });

    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');


}