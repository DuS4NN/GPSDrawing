<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    $action = $_POST['action'];
    $id = $_POST['id'];

    if($action==0){
        $stmt = $db->prepare("INSERT INTO `followers` (`follower`, `id_user`, `date`) VALUES (NULL, ?, ?);");
        $stmt->bind_param("iis", $_SESSION['id'],$id, $date);
        $stmt->execute();
    }else{
        $stmt = $db->prepare("DELETE FROM followers WHERE follower = ? AND id_user = ?");
        $stmt->bind_param("ii", $_SESSION['id'],$id );
        $stmt->execute();
    }


