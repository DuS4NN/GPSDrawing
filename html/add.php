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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>



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
        let text = fileString.split(">");
        for(let i=0; i<text.length;i++){
            if(text[i].toString().includes('lat')){
                let row = text[i].split("\"");
                points+=row[1]+";"+row[3]+";";
            }
        }
        points=points.substring(0,points.length-1);
        let desc = document.getElementById('add-desc-textarea').value;
        let radio = $('input[name=radio]:checked', '#radio').val();
        $('#alerts-2').load(localStorage.getItem("web")+"/php/add-post.php",{points: points, desc: desc, radio: radio});
        setTimeout(function () {
            window.location=localStorage.getItem("web")+"/user/<?php echo $_SESSION['nickname']; ?>";
        },100);

    }

</script>

    <script src="<?php echo $web ?>/js/classie.js"></script>

</body>
</html>