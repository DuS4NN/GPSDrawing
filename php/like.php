<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    $action = $_POST['action'];
    $id = $_POST['id'];

    if($action==0){
        $stmt = $db->prepare("INSERT INTO `likes` (`id`, `id_post`, `id_user`) VALUES (NULL, ?, ?);");
        $stmt->bind_param("ii", $id, $_SESSION['id']);
        $stmt->execute();
    }else{
        $stmt = $db->prepare("DELETE FROM likes WHERE id_post = ? AND id_user = ?");
        $stmt->bind_param("ii", $id, $_SESSION['id']);
        $stmt->execute();
    }


