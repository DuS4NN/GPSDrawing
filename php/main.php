<?php

    session_start();
    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
        //header("location: ../GPSDrawing/welcome");
        //$_SESSION['alerts'] = "error:9";
        $_SESSION['id'] = "5";
    }
    require '../config/db.php';
    require '../config/lang.php';
    header("Content-type: text/html; charset=windows-1250");

?>

<!DOCTYPE html >
<html>
<head>
    <title><?php echo $lang['title_index'] ?></title>
    <meta http-equiv="Content-Type" content="text/html;charset=windows-1250">
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&callback=initMap"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    <div id="body">
    <?php



    $stmt = $db->prepare("SELECT 
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, users.first_name, posts.description, posts.date, posts.distance, posts.points, posts.time, posts.activity, COUNT(comments.id) as 'countcomments', COUNT(likes.id) as 'countlikes',
                                CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = '".$_SESSION['id']."' AND likes.id_post = posts.id) 
                                     THEN '1' 
                                     ELSE '0'
                                     END AS 'liked' 
                                FROM posts LEFT JOIN comments ON comments.id = posts.id INNER JOIN users ON users.id = posts.id_user LEFT JOIN likes ON likes.id_post = posts.id GROUP BY posts.id ORDER BY posts.date DESC");

        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            include("../html/main-post.php");

            date_default_timezone_set('Europe/London');
            $curentDate = date("Y-m-d  H-i");
        }
    ?>

    </div>
    <div id="alerts">
        <?php require '../php/alerts.php';
        ?>
    </div>
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
    <script src="<?php echo $web ?>/js/like.js"></script>
    <script src="<?php echo $web ?>/js/load-map.js"></script>
</body>
</html>
