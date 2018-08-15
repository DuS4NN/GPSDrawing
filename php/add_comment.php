<?php
    require '../config/db.php';
    session_start();

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['text']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        echo $_POST['id']." ".$_POST['text']." ".$_SESSION['id'];
        return;
    }

    $id = $_POST['id'];
    $text = $_POST['text'];

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");

    $stmt = $db->prepare("INSERT INTO comments (id_user, id_post, comment, time) VALUES (?,?,?,?)");
    $stmt->bind_param("iiss", $_SESSION['id'], $id, $text, $date);
    $stmt->execute();
    echo 'aaaaaa';