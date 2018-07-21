﻿<?php
    session_start();
    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
        //header("location: ../GPSDrawing/welcome");
        //$_SESSION['alerts'] = "error:9";
        $_SESSION['id'] = "1";
    }
    require '../config/db.php';
    require '../config/lang.php';
    header("Content-type: text/html; charset=windows-1250");

?>

<html>
<head>
    <title><?php echo $lang['title_index'] ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=windows-1250">
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo $web ?>/css/jquery.contextMenu.css">
    <script src="<?php echo $web; ?>/js/jquery.contextMenu.js"></script>
    <script src="<?php echo $web; ?>/js/jquery.ui.position.js"></script>


</head>
<body>

    <div id="body">
        <?php

    $stmt = $db->prepare("SELECT 
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, users.first_name, posts.description, posts.date, 
                                posts.distance, posts.points, posts.time, posts.activity, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id) 
                                THEN '1' 
                                ELSE '0'
                                END AS 'liked',
                                CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                THEN '1'
                                ELSE '0'
                                END AS 'bookmark',
                                (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                FROM posts 
                                LEFT JOIN comments ON comments.id_post = posts.id 
                                INNER JOIN users ON users.id = posts.id_user 
                                GROUP BY posts.id 
                                ORDER BY posts.date DESC");
        $stmt->bind_param("ss",$_SESSION['id'], $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {

            if($row['collaboration']!=0){
                $stmt2 = $db->prepare("SELECT DISTINCT users.nick_name FROM `users_in_collab` INNER JOIN users ON users_in_collab.id_user = users.id WHERE users_in_collab.id_collaboration = ?");
                $stmt2->bind_param("i", $row['collaboration']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
            }else{
                $result2=null;
            }
            include("../html/main-post.php");
        }
    ?>

    </div>
    <div id="alerts">
        <?php require '../php/alerts.php';
        ?>
    </div>

    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <h3>Are you sure ?</h3>
            <div>
                <i class="fas fa-exclamation-circle"></i>

                <p>Do you really want to delete this comment?
                     This process cannot be undone.</p>

                <div class="md-modal-buttons">
                    <br><br>
                    <button class="md-delete">Delete</button>
                    <button class="md-close">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="md-overlay"></div>
    <script src="<?php echo $web ?>/js/classie.js"></script>
    <script src="<?php echo $web ?>/js/modalEffects.js"></script>
    <script>
        var close = document.getElementsByClassName("closebtn");
        var i;

        for (i = 0; i < close.length; i++) {
            close[i].onclick = function(){
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function(){ div.style.display = "none"; }, 600);
            }
        }
    </script>
    <script src="<?php echo $web ?>/js/comments.js"></script>
    <script src="<?php echo $web ?>/js/like.js"></script>
    <script src="<?php echo $web ?>/js/load-map.js"></script>

    <script src="<?php echo $web; ?>/js/load-theme.js"></script>

</body>
</html>
