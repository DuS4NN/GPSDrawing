window.initMap = function (id,point,color,collab,color_icon,icons, theme,travelmode) {
    if (id == null) return;

    const service = new google.maps.DirectionsService;
    const map = new google.maps.Map(document.getElementById('map' + id));
    const styledMap = get_theme(theme);

    const controlsOut = {
        disableDoubleClickZoom: true,
        disableDefaultUI: true,
        mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                'styled_map']
        }
    };

    const controlsIn = {
        disableDoubleClickZoom: true,
        disableDefaultUI: false,
        mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                'styled_map']
        }
    };

    map.setOptions(controlsOut);

    google.maps.event.addDomListener(map.getDiv(),
        'mouseover',
        function (e) {
            e.cancelBubble = true;
            if (!map.hover) {
                map.hover = true;
                map.setOptions(controlsIn);
            }
        });

    google.maps.event.addDomListener(document.getElementsByTagName('body')[0],
        'mouseover',
        function () {
            if (map.hover) {
                map.setOptions(controlsOut);
                map.hover = false;
            }
        });

    let travel = 'WALKING';
    switch (travelmode) {
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

    map.mapTypes.set('styled_map', styledMap);
    map.setMapTypeId('styled_map');


    setTimeout(function () {
        if (point.includes('*')) {
            collaboration();
        } else {
            post();
        }
    }, 10);


    function post() {

        //----------- LEN PRE POSTY -----------
        let points = point.split(';');
        let stations = [];
        let parts = [];


        //Do pola stations sa pridajú všetky body.
        for (let i = 0; i < points.length; i += 2) {
            stations[i / 2] = {lat: parseFloat(points[i]), lng: parseFloat(points[i + 1]), name: 'Station'};
        }

        //Zoom na stred mapy, aby bolo vidie celú kresbu.
        let lngs = stations.map(function (station) {
            return station.lng;
        });
        let lats = stations.map(function (station) {
            return station.lat;
        });
        map.fitBounds({
            west: Math.min.apply(null, lngs),
            east: Math.max.apply(null, lngs),
            north: Math.min.apply(null, lats),
            south: Math.max.apply(null, lats),
        });


        //Pole stations sa rozdelí na menšie (25) èasti do parts pretože Google server blokuje väšie požiadavky ako 25 súradníc.
        for (let i = 0, max = 25 - 1; i < stations.length; i = i + max) {
            parts.push(stations.slice(i, i + max + 1));
        }

        //Urèí sa travel mode.
        let travel = 'WALKING';
        switch (travelmode) {
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


        if(window.location.href.includes('/post/')) {
            var chartDiv = document.getElementById('elevation_chart');
            var elevator = new google.maps.ElevationService;
            var elevStations = [];

            displayPathElevation(stations,elevator, map);

            function displayPathElevation(stations, elevator, map) {
                // Display a polyline of the elevation path.
                new google.maps.Polyline({
                    path: stations,
                    strokeColor: color,
                    strokeOpacity: 1,
                    map: map
                });

                // Create a PathElevationRequest object using this array.
                // Ask for 256 samples along that path.
                // Initiate the path request.
                elevator.getElevationAlongPath({
                    'path': stations,
                    'samples': 256
                }, plotElevation);
            }



            function plotElevation(elevations, status) {

                if (status !== 'OK') {
                    // Show the error code inside the chartDiv.
                    chartDiv.innerHTML = 'Cannot show elevation: request failed because ' +
                        status;
                    return;
                }

                //let geocoder = new google.maps.Geocoder;
                /*geocoder.geocode({'location': }, function(results, status) {
                    if(status==='OK'){

                    }

                });*/

                const options = {
                    vAxis: {
                        textPosition: 'none',
                        textStyle:{
                            color: '#000000',
                            fontName: 'Text2',
                            bold: true,
                            fontSize: '13',
                        },
                        gridlines:{
                            color:'transparent',
                            count:3
                        }
                    },
                    hAxis:{
                        gridlines:{
                            color:'transparent',
                            count:0
                        }
                    },
                    backgroundColor: 'transparent',
                    height: 120,
                    chartArea: {
                        height: '100%',
                        width: '100%',
                        left:'0'
                    },
                    legend: 'none',
                    pointSize: 0,
                    colors: [color]
                };


                var chart = new google.visualization.AreaChart(chartDiv);

                // Extract the data from which to populate the chart.
                // Because the samples are equidistant, the 'Sample'
                // column here does double duty as distance along the
                // X axis.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Sample');
                data.addColumn('number', 'Elevation');
                for (var i = 0; i < elevations.length; i++) {

                    elevStations.push({lat: elevations[i].location.lat(), lng: elevations[i].location.lng()});
                    data.addRow(['', elevations[i].elevation]);
                }

                const icon = {
                    url: 'https://png.icons8.com/ios/40/' + color_icon.substring(1, color_icon.length) + '/filled-circle-filled.png',
                    scaledSize: new google.maps.Size(12, 12),
                    anchor: new google.maps.Point(7, 6)
                };

                marker = new google.maps.Marker({
                    map: map,
                    icon: icon,
                });

                google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                    marker.setPosition(elevStations[e.row]);
                });


                $(window).resize(function() {
                    if(this.resizeTO) clearTimeout(this.resizeTO);
                    this.resizeTO = setTimeout(function() {
                        $(this).trigger('resizeEnd');
                    }, 200);
                });

                //redraw graph when window resize is completed
                $(window).on('resizeEnd', function() {
                    chart.draw(data,options);
                });



                chart.draw(data, options);
            }
        }


        //Odpoveï serveru
        let count_dis = 0;
        let count_time = 0;
        let count_all = 0;

        let service_callback = function (response, status) {
            if (status === 'OK') {

                if(window.location.href.includes('/post/')){
                    if(count_all===0){
                        $('#post-start-location').text(response.routes[0].legs[0].start_address);
                        $('#post-start-location').mouseover(function(e) {
                            marker.setPosition(elevStations[0]);
                        });

                    }
                    if(count_all===parts.length-1){
                        $('#post-end-location').text(response.routes[0].legs[0].end_address);
                        $('#post-end-location').mouseover(function(e) {
                            marker.setPosition(elevStations[elevStations.length-1]);
                        });
                    }
                    count_all++;
                }


                if(!window.location.href.includes('projects')){
                    //Nastavenie èasu a vzdialenosti k príspevku
                    let num_time = parseFloat(response.routes[0].legs[0].duration.value);
                    count_time = count_time + num_time;

                    let num_distance = parseFloat(response.routes[0].legs[0].distance.value);
                    count_dis = count_dis + num_distance;

                    if (count_time <= 60) {
                        $('#post-footer-duration-' + id).text(count_time + " s");
                    } else if (count_time > 60 && count_time < 3600) {
                        $('#post-footer-duration-' + id).text(parseInt(count_time / 60) + " min");
                    } else {
                        $('#post-footer-duration-' + id).text(parseInt(count_time / 60 / 60) + " h" + " " + parseInt(count_time / 60 % 60) + " min");
                    }

                    $('#post-footer-distance-' + id).text(Math.round((count_dis / 1000) * 10) / 10 + " km");
                }

                //Nastavenie pre renderer - vykreslovanie èiar na mapu
                const renderer = new google.maps.DirectionsRenderer;
                renderer.setMap(map);
                renderer.setOptions({
                    suppressMarkers: true,
                    preserveViewport: true,
                    polylineOptions: {
                        strokeColor: color
                    }
                });

                //Nakreslenie èiary na mapu
                renderer.setDirections(response);

            } else {
                delayedLog(item_old);
                console.log("ERROR: " + status + " Trying again..");
            }
        };

        let item_old = [];
        //Postupné posielanie požiadaviek serveru.
        proccessArray(parts);


        async function proccessArray(parts) {
            for (const item of parts) {
                await delayedLog(item);
            }
        }

        async function delayedLog(item) {
            //Delay - server berie maximálne jednu požiadavku za sekundu.
            await delay();
            item_old = item;

            //Vytvoria sa wapointy.
            let waypoints = [];
            for (let j = 1; j < item.length - 1; j++) {
                waypoints.push({location: item[j], stopover: false});
            }

            //Vytvoria sa nastavenia.
            let service_options = {
                origin: item[0],
                destination: item[item.length - 1],
                waypoints: waypoints,
                travelMode: travel
            };

            //Odošle sa požiadavka na server.
            service.route(service_options, service_callback);

        }

        function delay() {
            return new Promise(resolve => setTimeout(resolve, 250));
        }
    }

    function collaboration() {

        //----------- LEN PRE SPOLUPRÁCE -----------
        const array = point.split("*");
        const map_points = [];
        const stations = [];
        const users = [];
        const points = [];

        for (let i = 0; i < array.length; i += 2) {
            users.push(array[i]);
            points.push(array[i + 1]);
        }

        let count = 0;

        for (let i = 0; i < points.length; i++) {
            map_points[i] = [];
            let points_split = points[i].split(";");
            for (let j = 0; j < points_split.length; j += 2) {
                map_points[i][j / 2] = {
                    lat: parseFloat(points_split[j]),
                    lng: parseFloat(points_split[j + 1]),
                    name: 'Station'
                };
                stations[count] = {
                    lat: parseFloat(points_split[j]),
                    lng: parseFloat(points_split[j + 1]),
                    name: 'Station'
                };
                count++;
            }
        }

        const icon = {
            url: 'https://png.icons8.com/ios-glyphs/40/' + color_icon.substring(1, color_icon.length) + '/user-location.png',
            scaledSize: new google.maps.Size(28, 28)
        };

        const line_colors = [];
        const direction = [];

        if (collab == 1) {
            let color_RGB = [parseInt(color.substring(1, 3), 16), parseInt(color.substring(3, 5), 16), parseInt(color.substring(5, 7), 16)];
            let hue = rgb2hue(color_RGB[0], color_RGB[1], color_RGB[2]);
            let add = Math.round(100 / users.length);

            for (let i = 0; i < users.length; i++) {
                let saturation = 100 - i * add;
                line_colors.push('hsl(' + hue.toString() + ',' + saturation.toString() + '%,50%)');
            }
        } else if (collab == 0) {
            for (let i = 0; i < users.length; i++) {
                line_colors.push(color);
            }

        }


        let lngs = stations.map(function (station) {
            return station.lng;
        });
        let lats = stations.map(function (station) {
            return station.lat;
        });

        map.fitBounds({
            west: Math.min.apply(null, lngs),
            east: Math.max.apply(null, lngs),
            north: Math.min.apply(null, lats),
            south: Math.max.apply(null, lats),
        });

        let travel = 'WALKING';
        switch (travelmode) {
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

        //----------------------------------------------------
        if(window.location.href.includes('/post/')) {
            const chartDiv = document.getElementById('elevation_chart');
            const elevator = new google.maps.ElevationService;

            const chart = new google.visualization.AreaChart(chartDiv);



            let colorChart = line_colors[0].replace(/[hsl()%]/g,'').split(',');
            let color_RGB = hslToRgb(colorChart[0],colorChart[1],colorChart[2]);
            console.log(color_RGB);

            const options = {
                vAxis: {
                    textPosition: 'none',
                    textStyle:{
                        color: '#000000',
                        fontName: 'Text2',
                        bold: true,
                        fontSize: '13',
                    },
                    gridlines:{
                        color:'transparent',
                        count:3
                    }
                },
                hAxis:{
                    gridlines:{
                        color:'transparent',
                        count:0
                    }
                },
                backgroundColor: 'transparent',
                height: 120,
                chartArea: {
                    height: '100%',
                    width: '100%',
                    left:'0'
                },
                legend: 'none',
                isStacked: true,
                pointSize: 0,
                colors: ['red','green','blue']
            };
            let data = new google.visualization.DataTable();

            const elevStations = [];
            const elevArray = [];


            let count=0;

            data.addColumn('string','Elevation');

            for(let i=0; i<map_points.length;i++){
                new google.maps.Polyline({
                    path: map_points[i],
                    strokeColor: line_colors[i],
                    strokeOpacity: 1,
                    map: map
                });

                elevArray[i] = [];
                elevStations[i] = [];

                elevator.getElevationAlongPath({
                    'path': map_points[i],
                    'samples': 256
                }, function (elevations,status) {
                    if (status === 'OK') {
                        for (let j = 0; j < elevations.length; j++) {
                            elevStations[count].push({lat: elevations[j].location.lat(), lng: elevations[j].location.lng()});
                            elevArray[count].push(elevations[j].elevation);
                        }
                        count++;
                        if(count===users.length){
                            drawChart();
                        }
                    }

                });
            }

            function drawChart() {
                for(let i=0;i<users.length;i++){
                    data.addColumn('number',users[i]);
                }
                console.log(data);

                for(let i=0;i<elevArray[0].length;i++){
                    let row = ['Elevation'];

                    for(let j=0; j<elevArray.length;j++){
                        row.push(elevArray[j][i]);
                    }


                    data.addRow(row);
                }

                const icon = {
                    url: 'https://png.icons8.com/ios/40/' + color_icon.substring(1, color_icon.length) + '/filled-circle-filled.png',
                    scaledSize: new google.maps.Size(12, 12),
                    anchor: new google.maps.Point(7, 6)
                };

                marker = new google.maps.Marker({
                    map: map,
                    icon: icon,
                });

                google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                    marker.setPosition(elevStations[e.column-1][e.row]);
                });


                $(window).resize(function() {
                    if(this.resizeTO) clearTimeout(this.resizeTO);
                    this.resizeTO = setTimeout(function() {
                        $(this).trigger('resizeEnd');
                    }, 200);
                });

                //redraw graph when window resize is completed
                $(window).on('resizeEnd', function() {
                    chart.draw(data,options);
                });

                chart.draw(data, options);



            }

        }
        //----------------------------------------------------


        let count_dis = 0;
        let count_time = 0;

        for (let i = 0; i < map_points.length; i++) {

            if (icons === "1") {
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

             function service_callback(response, status) {

                if (status !== 'OK') {
                    delayedLog(old_item);
                    return;
                }


                if(!window.location.href.includes('projects')){
                    let num_time = parseFloat(response.routes[0].legs[0].duration.value);
                    count_time = count_time+num_time;


                    let num_distance = parseFloat(response.routes[0].legs[0].distance.value);
                    count_dis = count_dis+num_distance;

                    if (count_time <= 60) {
                        document.getElementById("post-footer-duration-" + id).innerText = count_time + " s";
                    } else if (count_time > 60 && count_time < 3600) {
                        document.getElementById("post-footer-duration-" + id).innerText = parseInt(count_time / 60) + " min";
                    } else {
                        document.getElementById("post-footer-duration-" + id).innerText = parseInt(count_time / 60 / 60) + " h" + " " + parseInt(count_time / 60 % 60) + " min";
                    }

                    document.getElementById("post-footer-distance-" + id).innerText = Math.round((count_dis / 1000) * 10) / 10 + " km";
                }


                direction.push(new google.maps.DirectionsRenderer({
                    suppressInfoWindows: true,
                    suppressMarkers: true,
                    preserveViewport: true,
                    polylineOptions: {
                        strokeColor: line_colors[i],
                        strokeWeight: 3
                    },
                    map: map
                }));
                direction[direction.length - 1].setDirections(response);

            }


            processArray(parts);

            function delay() {
                return new Promise(resolve => setTimeout(resolve,250));
            }

            let old_item;
            async function delayedLog(item) {
                await delay();
                old_item = item;

                let waypoints = [];
                for (let k = 1; k < item.length - 1; k++)
                    waypoints.push({location: item[k], stopover: false});
                // Service options
                let service_options = {
                    origin: item[0],
                    destination: item[item.length - 1],
                    waypoints: waypoints,
                    travelMode: travel
                };

                service.route(service_options,service_callback);

            }

            async function processArray(parts) {
                for(const item of parts){
                    await delayedLog(item);
                }

            }

        }

    }

};

function hslToRgb(h, s, l) {
    var r, g, b;

    if (s == 0) {
        r = g = b = l; // achromatic
    } else {
        function hue2rgb(p, q, t) {
            if (t < 0) t += 1;
            if (t > 1) t -= 1;
            if (t < 1/6) return p + (q - p) * 6 * t;
            if (t < 1/2) return q;
            if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;

        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return [ r * 255, g * 255, b * 255 ];
}

function rgb2hue(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;
    let max = Math.max(r, g, b);
    let min = Math.min(r, g, b);
    let c   = max - min;
    let hue, segment, shift;
    if (c === 0) {
        hue = 0;
    } else {
        switch(max) {
            case r:
                segment = (g - b) / c;
                shift   = 0 / 60;       // R° / (360° / hex sides)
                if (segment < 0) {          // hue > 180, full rotation
                    shift = 360 / 60;         // R° / (360° / hex sides)
                }
                hue = segment + shift;
                break;
            case g:
                segment = (b - r) / c;
                shift   = 120 / 60;     // G° / (360° / hex sides)
                hue = segment + shift;
                break;
            case b:
                segment = (r - g) / c;
                shift   = 240 / 60;     // B° / (360° / hex sides)
                hue = segment + shift;
                break;
        }
    }
    return Math.round(hue * 60); // hue is in [0,6], scale it up
}

function initMap2(id) {
    let styledMapType = get_theme(id);

    let map = new google.maps.Map(document.getElementById('settings-map'+id), {
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
