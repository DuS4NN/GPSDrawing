<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) ){
        return;
    }

    $id = $_POST['id'];

    switch ($_POST['action']){
        case 0:
            $stmt = $db->prepare("INSERT INTO `blocked_posts` (`id`, `id_user`, `id_post`) VALUES (NULL, ?, ?)");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            break;
        case 1:
            $stmt = $db->prepare("INSERT INTO `bookmarks` (`id`, `id_user`, `id_post`) VALUES (NULL, ?, ?)");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            echo '
            <div class="alert inf" >
               <span class="closebtn">&times;</span>  
              '.$lang['info1'].' 
            </div>          
            ';
            break;
        case 2:
            $stmt = $db->prepare("DELETE FROM `bookmarks` WHERE bookmarks.id_user = ? AND bookmarks.id_post = ?");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            break;
        case 3:
            $stmt = $db->prepare("DELETE FROM `posts` WHERE posts.id_user = ? AND posts.id = ?");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            break;
    }
