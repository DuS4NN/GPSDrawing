<?php

session_start();
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    $_SESSION['alerts'] = "error:9";
    header("location: ../GPSDrawing/welcome");
}
require '../config/db.php';
require '../config/lang.php';
ini_set("default_charset", "UTF-8");
header('Content-type: text/html; charset=UTF-8');

?>

<html>
<head>
    <title><?php echo $lang['title_index'] ?></title>
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="<?php echo $web ?>/js/load-map.js"></script>
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>
    <script src="https://www.google.com/jsapi"></script>



</head>
<body>

<script>
    google.load('visualization', '1', {packages: ['columnchart']});
</script>

<?php require '../html/header.html'; ?>

<div id="body" style="width: 100%; left:0;">
    <?php

    $stmt = $db->prepare("SELECT
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date,
                                posts.points, posts.activity, posts.collaboration, COUNT(comments.id) as 'countcomments',
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
                                WHERE posts.id = ?
                                GROUP BY posts.id
                                HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)");

    $stmt->bind_param("sssss",$_SESSION['id'], $_SESSION['id'],$_GET['post'], $_SESSION['id'], $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_rows = mysqli_num_rows($result);
    if($num_rows==0){
        echo '<div id="content-empty">
                '.$lang['error30'].'  
              </div>
';
        return;
    }

    $row = $result->fetch_assoc();

    if($row['collaboration']!=0){
        $stmt2 = $db->prepare("SELECT DISTINCT users.nick_name FROM `users_in_collab` INNER JOIN users ON users_in_collab.id_user = users.id WHERE users_in_collab.id_collaboration = ?");
        $stmt2->bind_param("i", $row['collaboration']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
    }else{
        $result2=null;
    }
    include("../html/main-post.php");

    ?>

    <div id="elevation_chart"></div>


    <div id="alerts-2">
    <?php require '../php/alerts.php'; ?>
</div>


<?php require '../html/modals.html'; ?>


<div id="overlay" class="md-overlay"></div>


<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/modalEffects.js"></script>
<script src="<?php echo $web ?>/js/comments.js"></script>
<script src="<?php echo $web ?>/js/post-more.js"></script>
<script src="<?php echo $web ?>/js/like.js"></script>
<script src="<?php echo $web; ?>/js/load-theme.js"></script>

</body>
</html>
