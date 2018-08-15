<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    $action = $_POST['action'];
    $id = $_POST['id'];

    if($action==0){
        $stmt = $db->prepare("INSERT INTO `likes` (id_user, `id_post` ) VALUES (?, ?);");
        $stmt->bind_param("ii", $_SESSION['id'],$id);
        $stmt->execute();
    }else{
        $stmt = $db->prepare("DELETE FROM likes WHERE id_user = ? AND id_post = ?");
        $stmt->bind_param("ii", $_SESSION['id'],$id );
        $stmt->execute();
    }


