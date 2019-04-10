<?php

    $web = "http://localhost/GPSDrawing";
    echo "<script> localStorage.setItem('web','http://localhost/GPSDrawing'); </script>";


    if(!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = "en";

    }else if(isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang']) ){
        if($_GET['lang'] == "en"){
            $_SESSION['lang'] = "en";
        }else if($_GET['lang'] == "sk"){
            $_SESSION['lang'] = "sk";
        }
    }

    require_once "../languages/". $_SESSION['lang'] .".php";

echo "<script>localStorage.setItem('lang','"; echo $_SESSION['lang'];  echo "');</script>";
