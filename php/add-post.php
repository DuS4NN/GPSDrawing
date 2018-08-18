<?php
    require '../config/db.php';
    require '../config/lang.php';
    session_start();

    if(!isset($_POST['points']) || empty($_POST['points']) ||  !isset($_POST['radio'])){
        echo 'dasdasdasdasd';
        return;
    }

    if($_POST['radio'] != 0 && $_POST['radio'] != 1 && $_POST['radio'] != 2 && $_POST['radio'] != 3 ){
        $_POST['radio'] = 0;
    }

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");
    $collab =0;
    $stmt = $db->prepare("INSERT INTO posts (id_user, date, activity, description, points,collaboration) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("isssss", $_SESSION['id'], $date, $_POST['radio'], $_POST['desc'], $_POST['points'], $collab);
    $stmt->execute();

    $_SESSION['alerts'] = "success:5";