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
            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info4'].'</div>';
            break;
        case 1:
            $stmt = $db->prepare("INSERT INTO `bookmarks` (`id`, `id_user`, `id_post`) VALUES (NULL, ?, ?)");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info1'].'</div>';
            break;
        case 2:
            $stmt = $db->prepare("DELETE FROM `bookmarks` WHERE bookmarks.id_user = ? AND bookmarks.id_post = ?");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();
            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info2'].'</div>';
            break;
        case 3:
            //Odstranit uzivatelov v kolaboracii
            $stmt = $db->prepare("DELETE FROM users_in_collab WHERE id_collaboration = (SELECT collaboration.id FROM collaboration INNER JOIN posts ON collaboration.id_post = posts.id WHERE id_post = ? AND posts.id_user = ?)");
            $stmt->bind_param("ii", $id,$_SESSION['id']);
            $stmt->execute();

            //Odstranit collab
            $stmt = $db->prepare("DELETE FROM collaboration WHERE id_post = (SELECT id FROM posts WHERE posts.id=? AND posts.id_user= ?)");
            $stmt->bind_param("ii", $id,$_SESSION['id']);
            $stmt->execute();


            //Odstranit post
            $stmt = $db->prepare("DELETE FROM `posts` WHERE posts.id_user = ? AND posts.id = ?");
            $stmt->bind_param("ii", $_SESSION['id'],$id);
            $stmt->execute();


            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info3'].'</div>';
            break;
        case 4:
            if(isset($_POST['reason'])){
                date_default_timezone_set('UTC');
                $time = date("Y-m-d H:i");
                $stmt = $db->prepare("INSERT INTO `reported_posts` (`id`, `id_user`, `id_post`,`time`,`reason`) VALUES (NULL, ?, ?, ?, ?)");
                $stmt->bind_param("iisi", $_SESSION['id'],$id, $time, $_POST['reason']);
                $stmt->execute();
                echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info5'].'</div>';
            }
            break;
        case 5:
            if(isset($_POST['text'])){
                $stmt = $db->prepare("UPDATE `posts` SET `description` = ? WHERE id = ? AND id_user = ?;");
                $stmt->bind_param("sii", $_POST['text'],$id, $_SESSION['id']);
                $stmt->execute();
                echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info6'].'</div>';
            }
            break;
    }
