<?php
     session_start();
    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
        $_SESSION['alerts'] = 'error:9';
        header("location: ../welcome");
    }

    require '../config/db.php';
    require '../config/lang.php';
    ini_set("default_charset", "UTF-8");
    header('Content-type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lang['title_index'] ?></title>
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/add.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
    <?php if($_SESSION['night_mode']==1)echo '<link rel="stylesheet" href="'.$web.'/css/dark_mode.css">';?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&language=en"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>

    <link rel="stylesheet" href="<?php echo $web ?>/css/emojionearea.css">
    <script src="<?php echo $web ?>/js/emojionearea.js"></script>


</head>
<body>
    <?php require '../html/header.html'; ?>


    <div id="add-container">


        <div id="add-desc">
            <div id="add-desc-text"><?php echo $lang['posts_description'];?></div>
            <textarea id="add-desc-textarea" maxlength="300" placeholder="<?php echo $lang['type_description'];?>"></textarea>
        </div>

        <div id="add-activity">

            <div id="add-activity-text"><?php echo $lang['select_activity'];?></div>

            <form id="radio">
                <label class="container"><?php echo $lang['walking'];?>
                    <input type="radio" value="0" checked="checked" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="container"> <?php echo $lang['running'];?>
                    <input type="radio" value="1" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="container"> <?php echo $lang['cycling'];?>
                    <input type="radio" value="2" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="container"> <?php echo $lang['driving'];?>
                    <input type="radio" value="3" name="radio">
                    <span class="checkmark"></span>
                </label>
            </form>

        </div>

        <div id="add-upload">
            <div id="add-upload-text">
                <?php echo $lang['select_file'];?>
            </div>
            <div id="add-upload-file">

                <label class="custom-file-upload">
                    <input  required accept=".gpx" id="upload-file" type="file"/>
                    <?php echo $lang['browse'];?>

                </label>
                <span id="custom-file-name"></span>

            </div>
        </div>

    </div>



    <div id="add-submit">
        <button onclick="add_post()"><?php echo $lang['add_post'];?></button>
    </div>


    <div id="alerts-2"></div>


<script>
    $('#upload-file').on('change',function () {
        let fileInput = document.getElementById('upload-file');
        let fileName = fileInput.value.split(/(\\|\/)/g).pop();

        if(!fileName.endsWith('.gpx')){
            document.getElementById('upload-file').value = "";
            document.getElementById('custom-file-name').innerText = "";
            return;
        }
        document.getElementById('custom-file-name').innerText = fileName;
    });


    function add_post(){
        let file = document.getElementById('upload-file').files[0];
        if(!file){
            document.getElementById('alerts-2').innerHTML =' <div class="alert remove" id="alert-main-post"> <span class="closebtn">&times;</span><?php echo $lang['error12']; ?></div>  ';
            closeAlert('remove');
            return;
        }
        let reader = new FileReader();
        reader.readAsText(file, "UTF-8");

        reader.onload = loaded;
    }

    function loaded(evt) {
        let points="";
        let fileString = evt.target.result;
        let text = fileString.split("\n");
        let duration = 0;
        let length = 0;
        let time = [];
        let first = false;

        let lastLat=0;
        let lastLon=0;

        for(let i=0; i<text.length;i++){
            if(text[i].toString().includes('lat')){
                let row = text[i].split("\"");
                points+=row[1]+";"+row[3]+";";

                if(first){
                    length = length+getDistanceFromLatLonInKm(lastLat,lastLon,row[1],row[3]);
                }

                lastLat=row[1];
                lastLon=row[3];
                first=true;
            }
            if(text[i].toString().includes('<time>')){
                time.push(text[i].replace(/[ ]/g,'').replace("<time>","").replace("</time>\r","").split(".")[0]);
            }
        }

        length=Math.round(length*1000);

        if(time.length>2){
            let date1 = new Date(time[0]);
            let date2 = new Date(time[time.length-1]);
            duration=date2-date1;
        }

        if(duration<0){
            duration=0;
        }

        const serviceGeocoder = new google.maps.Geocoder;
        let place = "";
        let stations = {lat: parseFloat(lastLat), lng: parseFloat(lastLon), name: 'Station '};

        serviceGeocoder.geocode({'location': stations},function (result,status) {
            if(status === 'OK') {
                place = result[result.length-3].formatted_address+"";

                points=points.substring(0,points.length-1);
                let desc = document.getElementById('add-desc-textarea').value;
                let radio = $('input[name=radio]:checked', '#radio').val();
                $('#alerts-2').load(localStorage.getItem("web")+"/php/add-post.php",{points: points, desc: desc, radio: radio, duration:duration,length:length, place:place});
                setTimeout(function () {
                    window.location=localStorage.getItem("web")+"/user/<?php echo $_SESSION['nickname']; ?>";
                },200);
            }
        });
    }

    function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1);
        var a =
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon/2) * Math.sin(dLon/2)
        ;
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c; // Distance in km
        return d;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180)
    }

</script>

    <script src="<?php echo $web ?>/js/classie.js"></script>

</body>
</html>