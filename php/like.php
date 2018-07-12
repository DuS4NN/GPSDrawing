<?php
    session_start();
    require '../config/db.php';

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


