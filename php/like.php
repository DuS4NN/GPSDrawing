<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");

    $action = $_POST['action'];
    $id = $_POST['id'];

    if($action==0){
        $stmt = $db->prepare("INSERT INTO `likes` (id_user, `id_post` ) VALUES (?, ?);");
        $stmt->bind_param("ii", $_SESSION['id'],$id);
        $stmt->execute();

        $action=1;$view=0;
        $stmt = $db->prepare("INSERT INTO `notification` (`id_user`, `action`, `post_user_id`, `view`, `date`) VALUES (?,?,?,?,?);");
        $stmt->bind_param("iiiis", $_SESSION['id'],$action,$id,$view,$date);
        $stmt->execute();

    }else{
        $stmt = $db->prepare("DELETE FROM likes WHERE id_user = ? AND id_post = ?");
        $stmt->bind_param("ii", $_SESSION['id'],$id );
        $stmt->execute();
    }


