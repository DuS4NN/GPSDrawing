window.initMap = function (id,point,color,collab,color_icon,icons, theme,travelmode) {

    if(id == null) return;

    //Kon�tanty
    const serviceElevator = new google.maps.ElevationService;
    const serviceGeocoder = new google.maps.Geocoder;
    const map = new google.maps.Map(document.getElementById('map'+id), {center: {lat: -34.397, lng: 150.644}, zoom: 8});
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

    //Event - Map hover - zobraz� sa UI - Nastavenie mapy sa zmen� na ControlsIn
    google.maps.event.addDomListener(map.getDiv(),
        'mouseover',
        function (e) {
            e.cancelBubble = true;
            if (!map.hover) {
                map.hover = true;
                map.setOptions(controlsIn);
            }
        });

    //Event - Map hover - skryje sa UI - Nastavenie mapy sa zmen� na ControlsOut
    google.maps.event.addDomListener(document.getElementsByTagName('body')[0],
        'mouseover',
        function () {
            if (map.hover) {
                map.setOptions(controlsOut);
                map.hover = false;
            }
        });

    //Nastavenie vlastnost� a �t�l mapy
    map.setOptions(controlsOut);
    map.mapTypes.set('styled_map', styledMap);
    map.setMapTypeId('styled_map');

    //Nastavenie travel modu
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

    setTimeout(function () {
        if(point.includes('*')){
            //Ide o spolupr�cu
            collaboration();
        }else{
            //Ide o norm�lny pr�spevok
            post();
        }
    },20);


    function post() {
        //Kon�tatny
        const points = point.split(';');
        let stations = [];

        //Do pola stations sa pridaj� v�etky body, ktor� sa neskor vykreslia
        for(let i=0; i<points.length;i+=2){
            stations[i/2] = {lat: parseFloat(points[i]), lng: parseFloat(points[i + 1]), name: 'Station '+i/2};
        }

        //Zoom na stred mapy tak, aby bolo vidie� cel� kresbu
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

        //Vykreslenie bodov
        new google.maps.Polyline({
            path: stations,
            strokeColor: color,
            strokeOpacity: 1,
            map: map
        });

        //Len pre str�nku postu - gpsdrawing/post/**
        if(window.location.href.includes('/post/')){
            //Kon�tanty
            const chartDiv = document.getElementById('elevation_chart');
            const chart = new google.visualization.AreaChart(chartDiv);
            const data = new google.visualization.DataTable();
            const elevStations = [];
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
            const icon = {
                url: 'https://png.icons8.com/ios/40/' + color_icon.substring(1, color_icon.length) + '/filled-circle-filled.png',
                scaledSize: new google.maps.Size(12, 12),
                anchor: new google.maps.Point(7, 6)
            };
            const divStart = $('#post-start-location');
            const divEnd = $('#post-end-location');

            //Marker pre hover event na graf
            let marker = new google.maps.Marker({
                map: map,
                icon: icon,
            });

            //Odoslanie po�iadavky serveru pre z�skanie st�pania
            serviceElevator.getElevationAlongPath({
                'path': stations,
                'samples': 256
            }, plotElevation);

            //Odchytenie odpovede serveru na po�iadavku pre z�skanie st�pania
            function plotElevation(elevations, status) {
                if(status === 'OK'){

                    //Vytvorenie st�pcov pre graf
                    data.addColumn('string','Sample');
                    data.addColumn('number','Elevation');

                    //Vytvorenie riadkov - naplnenie d�tami, ktor� pri�li, ako odpove� z na�ej po�iadavky
                    for(let i=0; i<elevations.length;i++){

                        //Pridanie do po�a, ktor� s���i na zobrazenie konkr�tneho bodu grafu na mape
                        elevStations.push({lat: elevations[i].location.lat(), lng: elevations[i].location.lng()});

                        //Pridanie riadku
                        data.addRow(['',elevations[i].elevation]);
                    }

                    //Vykreslenie grafu
                    chart.draw(data, options);

                    //Hover event - e.row vr�ti konkr�tny riadok, na ktor� sme uk�zali na grafe
                    //s�radnice pre dan� riadok zoberieme z po�a elevStations a s�radnice nastav�me vy��ie vytvoren�mu marker-u
                    google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                        marker.setPosition(elevStations[e.row]);
                    });


                    $(window).resize(function() {
                        if(this.resizeTO) clearTimeout(this.resizeTO);
                        this.resizeTO = setTimeout(function() {
                            $(this).trigger('resizeEnd');
                        }, 200);
                    });

                    //Prekreslenie grafu, ke� resize okna je skon�en�
                    $(window).on('resizeEnd', function() {
                        chart.draw(data,options);
                    });

                }else{
                    chartDiv.innerHTML = 'Cannot show elevation: request failed because ' + status;
                }
            }

            //Odoslanie a odchytenie po�iadavky na z�skanie za�iato�nej adresy kresby
            serviceGeocoder.geocode({'location': stations[0]},function (result,status) {
               if(status === 'OK') {
                   //Vyp�sanie adresy
                   divStart.append(result[0].formatted_address);

                   //Hover na adresu - uk�e na na mape
                   divStart.mouseover(function() {
                       marker.setPosition(elevStations[0]);
                   });
               }
            });

            //Odoslanie a odchytenie po�iadavky na z�skanie koncovej adresy kresby
            serviceGeocoder.geocode({'location': stations[stations.length-1]},function (result,status) {
                if(status === 'OK') {
                    //Vyp�sanie adresy
                    divEnd.append(result[0].formatted_address);

                    //Hover na adresu - uk�e na na mape
                    divEnd.mouseover(function() {
                        marker.setPosition(elevStations[elevStations.length-1]);
                    });
                }
            });
        }
    }

    function collaboration(){
        //Kon�tanty
        const array = point.split('*');//Tvar point - User*PointLAT;PointLNG;PointLAT;PointLNG*User*PointLAT;PointLNG..
        const points = [];
        const users = [];

        const map_points = [];
        const stations = [];

        const icon = {
            url: 'https://png.icons8.com/ios-glyphs/40/' + color_icon.substring(1, color_icon.length) + '/user-location.png',
            scaledSize: new google.maps.Size(28, 28)
        };

        const line_colors = [];

        //Naplnenie �dajov do po�a users a points
        for (let i = 0; i < array.length; i += 2) {
            // Tvar array - [User][PointLAT;PointLNG;PointLAT;PointLNG][User][PointLAT;PointLNG;PointLAT;PointLNG]..
            users.push(array[i]); //Tvar -[User][User]..
            points.push(array[i + 1]); //Tvar - [PointLAT;PointLNG;PointLAT;PointLNG][PointLAT;PointLNG;PointLAT;PointLNG]..
        }

        //Spracovanie �dajov na zobrazite�n� formu
        let count = 0;
        for(let i=0; i<points.length;i++){
            map_points[i] = [];
            let points_split = points[i].split(";"); //Tvar - [Point][Point][Point]..
            for(let j=0; j<points_split.length; j+=2){

                //Tvar - [0] [PointLAT,PointLNG][PointLAT,PointLNG][PointLAT,PointLNG]..
                //       [1] [PointLAT,PointLNG][PointLAT,PointLNG][PointLAT,PointLNG]..
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

        //Ak collab = 1, u��vate� m� zapnut� "multi color" �iary - ka�d� u��vate� m� vlastn� farbu �iary
        if (collab === "1") {
            //Pod�a nastavenej farby �iary sa vypo��ta z RGB na HSL, ka�d� u��vate� m� rovnak� farbu (H), ale men� sa S
            //Do po�a, sa teda prid� X (po�et u��vate�ov zapojen�ch v spolupr�ci) odtienov rovnakej farby - od najsvetlej�ej po najtmav�iu
            let color_RGB = [parseInt(color.substring(1, 3), 16), parseInt(color.substring(3, 5), 16), parseInt(color.substring(5, 7), 16)];
            let hue = rgb2hue(color_RGB[0], color_RGB[1], color_RGB[2]);
            let add = Math.round(100 / users.length);

            for (let i = 0; i < users.length; i++) {
                let saturation = 100 - i * add;
                line_colors.push('hsl(' + hue.toString() + ',' + saturation.toString() + '%,50%)');
            }
        } else if (collab === "0") {

            //Ka�d�mu u��vate�ovi sa nastav� rovnak�, zvolen�, farba
            for (let i = 0; i < users.length; i++) {
                line_colors.push(color);
            }

        }

        //Zoom na stred kresby tak, aby bo�a vidie� cel� kresba
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


        //Vykreslenie bodov a ikon
        for(let i=0; i<users.length;i++){

            //Vykreslenie bodov
            new google.maps.Polyline({
                path: map_points[i],
                strokeColor: line_colors[i],
                strokeOpacity: 1,
                map: map
            });

            //Ak m� u��vate� zapnut� zobrazovanie ikony u��vate�a
            if(icons === "1"){
                let marker = new google.maps.Marker({
                    position: map_points[i][0],
                    icon: icon,
                    map: map
                });

                let content = users[i];
                let info_window = new google.maps.InfoWindow();

                //Kliknut�m na ikonu sa zobraz� meno u��vate�a
                google.maps.event.addListener(marker, 'click', (function (marker, content, info_window) {
                    return function () {
                        info_window.setContent(content);
                        info_window.open(map, marker);
                    };
                })(marker, content, info_window));
            }
        }

        //Len pre str�nku postu
        if(window.location.href.includes('/post/')){
            //Kon�tanty
            const chartDiv = document.getElementById('elevation_chart');
            const chart = new google.visualization.AreaChart(chartDiv);
            const data = new google.visualization.DataTable();
            const icon = {
                url: 'https://png.icons8.com/ios/40/' + color_icon.substring(1, color_icon.length) + '/filled-circle-filled.png',
                scaledSize: new google.maps.Size(12, 12),
                anchor: new google.maps.Point(7, 6)
            };
            const elevStations = [];
            const elevArray = [];
            const colorArray = [];

            //Google charts nepodporuje HSL format, tak�e ho prekonvertujeme na RPG a prid�me farby
            for(let i=0;i<users.length;i++){
                let color = line_colors[i].replace(/[%()hsl]/g,'').split(',');
                let hslColor = hslToRgb(color[0],color[1]/100,color[2]/100);
                colorArray.push('rgb('+hslColor[0]+','+hslColor[1]+','+hslColor[2]+')');
            }

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
                colors: colorArray
            };

            data.addColumn('string','Elevation');

            //Z�skanie d�t pre graf
            processArray(users);

            //Postupn� vykon�vanie funkcie delayedLog
            async function processArray(array) {
                for(let i=0;i<array.length;i++){
                    await delayedLog(i);
                }
            }

            //Postupn� posielanie po�iadaviek serveru
            async function delayedLog(i) {
                await delay();
                elevArray[i] = [];
                elevStations[i] = [];

                //Posielanie po�iadavky na st�panie
                serviceElevator.getElevationAlongPath({
                    'path': map_points[i],
                    'samples': 256
                },function (elevations,status) {
                    //Zachytenie odpovede serveru
                    if(status==='OK'){
                        //Spracovanie odpovede a roztriedenie do po�a
                        for(let j=0;j<elevations.length;j++){
                            elevArray[i].push(elevations[j].elevation);//Pole pre vykreslenie

                            //Pole pre zobrazonie ikony na mape, ak pou��vate� uk�e na graf
                            //Zobraz� sa pr�slu�n� bod grafu na mape
                            elevStations[i].push({lat: elevations[j].location.lat(), lng: elevations[j].location.lng()});
                        }
                        if(i===users.length-1){
                            //Ak je posledn� vykresli graf
                            drawChart();
                        }
                    }
                });
            }

            //Delay pre funkciu delayedLog
            function delay() {
                return new Promise(resolve => setTimeout(resolve,250));
            }

            //Funkcia na vykreslenie grafu
            function drawChart() {
                //Pridanie st�pcov pre ka�d�ho u��vate�a
                for(let i=0; i<users.length;i++){
                    data.addColumn('number',users[i]);
                }

                //Pridanie riadkov ku ka�d�mu st�pcu
                for(let i=0; i<elevArray[0].length;i++){
                    let row = ['Elevation'];

                    for(let j=0; j<elevArray.length;j++){
                        row.push(elevArray[j][i]);
                    }

                    data.addRow(row);
                }

                //Nakreslenie grafu
                chart.draw(data, options);

                //Marker pre hover event na graf
                marker = new google.maps.Marker({
                    map: map,
                    icon: icon,
                });

                //Hover event - e.row vr�ti konkr�tny riadok, na ktor� sme uk�zali na grafe
                //s�radnice pre dan� riadok zoberieme z po�a elevStations a s�radnice nastav�me vy��ie vytvoren�mu marker-u
                google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                    marker.setPosition(elevStations[e.column-1][e.row]);
                });

                $(window).resize(function() {
                    if(this.resizeTO) clearTimeout(this.resizeTO);
                    this.resizeTO = setTimeout(function() {
                        $(this).trigger('resizeEnd');
                    }, 200);
                });

                //Prekreslenie grafu, ke� resize okna je skon�en�
                $(window).on('resizeEnd', function() {
                    chart.draw(data,options);
                });


            }
        }
    }
};

function hslToRgb(h, s, l) {
    let c = (1 - Math.abs(2 * l - 1)) * s;
    let hp = h / 60.0;
    let x = c * (1 - Math.abs((hp % 2) - 1));
    let rgb1;
    if (isNaN(h)) rgb1 = [0, 0, 0];
    else if (hp <= 1) rgb1 = [c, x, 0];
    else if (hp <= 2) rgb1 = [x, c, 0];
    else if (hp <= 3) rgb1 = [0, c, x];
    else if (hp <= 4) rgb1 = [0, x, c];
    else if (hp <= 5) rgb1 = [x, 0, c];
    else if (hp <= 6) rgb1 = [c, 0, x];
    let m = l - c * 0.5;
    return [
        Math.round(255 * (rgb1[0] + m)),
        Math.round(255 * (rgb1[1] + m)),
        Math.round(255 * (rgb1[2] + m))];
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
                shift   = 0 / 60;       // R� / (360� / hex sides)
                if (segment < 0) {          // hue > 180, full rotation
                    shift = 360 / 60;         // R� / (360� / hex sides)
                }
                hue = segment + shift;
                break;
            case g:
                segment = (b - r) / c;
                shift   = 120 / 60;     // G� / (360� / hex sides)
                hue = segment + shift;
                break;
            case b:
                segment = (r - g) / c;
                shift   = 240 / 60;     // B� / (360� / hex sides)
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

    map.addListener('click', function() {
        $('.map-item-'+selectedMap).removeClass('selected');
        let id = map['__gm']['$']['id'].replace('settings-map','');
        $('.map-item-'+id).addClass('selected');
        setTimeout(function () {
            $.ajax({
                type:"POST",
                url: localStorage.getItem("web")+"/php/settings.php",
                data: {action:9,id: id},
                success: function(response){
                    let alertSection = document.getElementById("alerts-2");
                    let text = alertSection.innerHTML;
                    alertSection.innerHTML = text + response;
                    closeAlert('remove');
                }
            });
        },200);
    });



    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
}
