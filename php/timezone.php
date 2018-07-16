<?php

    if(!isset($_POST['date']) || empty($_POST['date']) ){
        return;
    }

    session_start();
    $dateU = $_POST['date'];
    $_SESSION['time'] = $dateU/60*3600*(-1);