<?php
    session_start();
    if(!isset($_POST['date']) || empty($_POST['date']) ){
        return;
    }


    $dateU = $_POST['date'];
    $_SESSION['time'] = $dateU/60*3600*(-1);