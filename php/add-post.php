<?php
    require '../config/db.php';
    require '../config/lang.php';
    session_start();

    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_POST['points']) || empty($_POST['points']) ||  !isset($_POST['radio'])){
        return;
    }

    if($_POST['radio'] != 0 && $_POST['radio'] != 1 && $_POST['radio'] != 2 && $_POST['radio'] != 3 ){
        $_POST['radio'] = 0;
    }

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");
    $collab =0;
    $stmt = $db->prepare("INSERT INTO posts (id_user, date, activity, description, points,collaboration,duration,length) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssss", $_SESSION['id'], $date, $_POST['radio'], $_POST['desc'], $_POST['points'], $collab,$_POST['duration'],$_POST['length']);
    $stmt->execute();

    $_SESSION['alerts'] = "success:5";