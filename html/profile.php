<?php
    session_start();
    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
        $_SESSION['alerts'] = 'error:9';
        header("location: ../welcome");

    }
    if(!isset($_GET['user']) || empty($_GET['user'])){
        $_SESSION['alerts'] = 'error:11';
        header("location: ../home");
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
        <link rel="stylesheet" href="<?php echo $web ?>/css/profile.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
        <script src="<?php echo $web ?>/js/load-map.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body>
        <?php require '../html/header.html'; ?>

        <?php
            $stmt = $db->prepare("SELECT id, nick_name, about, first_name, last_name, date, profile_picture, aa.collabcount,
                                        (SELECT COUNT(id) FROM posts WHERE posts.id_user = users.id) as 'postscount'
                                        FROM users 
                                        JOIN (SELECT 
                                             COUNT(DISTINCT id_collaboration) as collabcount 
                                             FROM users_in_collab 
                                             INNER JOIN users ON users.id = users_in_collab.id_user
                                             WHERE users_in_collab.id_collaboration
                                             NOT IN (SELECT collaboration 
                                                     FROM posts 
                                                     INNER JOIN users ON users.id = posts.id_user
                                                     WHERE users.nick_name = ?)) aa
                                        WHERE nick_name = ?");
            $stmt->bind_param("ss",$_GET['user'], $_GET['user']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row_u = $result->fetch_assoc();

        ?>
        <div id="profile">
            <div id="profile-image-profile">
                <img src="<?php echo $web ?>/<?php echo $row_u['profile_picture'] ?>" />
                <div id="profile-info-date">

                    <?php
                    echo $lang['since'].' ';
                    $date = $row_u['date'];
                    $newd = date_create_from_format('Y-m-d H:i',$date);
                    $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                    $time = time();


                    if($time-$milisec<60){
                        echo intval(($time-$milisec)).' '.$lang['sec'].'.';
                    }else if($time-$milisec<3600){
                        echo intval(($time-$milisec)/60) . ' min.';
                    }else if($time-$milisec<86400){
                        echo intval(($time-$milisec)/3600).' '.$lang['hod'].'.';
                    }else if($time-$milisec<2592000){
                        echo date("d. M H:i",$milisec);
                    }else{
                        $date1 = date("Y",$time);
                        $date2 = date("Y",$milisec);
                        if($date1==$date2){
                            echo date("d. M",$milisec);
                        }else{
                            echo date("d. M. Y",$milisec);
                        }
                    }

                    ?>
                </div>
            </div>
            <div id="profile-info">
                <div id="profile-info-nick">
                    <h5><?php echo $row_u['nick_name'];?></h5> <img src="<?php echo $web; ?>/img/more.png" />
                </div>
                <div id="profile-info-name">
                    <?php echo $row_u['first_name']. ' '. $row_u['last_name']; ?>
                </div>
                <div id="profile-info-about">
                    <?php echo $row_u['about']; ?>
                </div>
                <div id="profile-info-follow">
                    <button class="follow">Following</button>
                </div>

            </div>
        </div>

        <div id="profile-stats">
            <div id="profile-stat-item" class="first">
                <img src="https://png.icons8.com/windows/80/1ab188/map.png"> <?php echo $lang['posts'];?>: <br> <span id="profile-stat-item-numbers"><?php echo $row_u['postscount'];?></span>
            </div>
            <div id="profile-stat-item" class="center">
                <img src="https://png.icons8.com/windows/96/1ab188/conference-call.png"> <?php echo $lang['followers'];?>: <br> <span id="profile-stat-item-numbers">17641</span>
            </div>
            <div id="profile-stat-item">
                <img src="https://png.icons8.com/windows/64/1ab188/collaboration.png"> <?php echo $lang['collaborations'];?>: <br> <span id="profile-stat-item-numbers"><?php echo $row_u['collabcount'];?></span>
            </div>
        </div>

        <div id="profile-choose">
            <div id="profile-choose-icons">
                <div id="profile-choose-item" class="profile-choose-post select" item="post"><img id="profile-choose-post" src="https://png.icons8.com/ios-glyphs/90/000000/menu.png"> <?php echo $lang['users_posts'];?></div>
                <div id="profile-choose-item" class="profile-choose-collaboration" item="collaboration"> <img id="profile-choose-collaboration" src="https://png.icons8.com/windows/100/bbbbbb/groups.png"> <?php echo $lang['collaborations'];?></div>
            </div>
        </div>

        <script>
            $(document).on('click','#profile-choose-item',function () {
                var item = $(this).attr('item');
                $(".body").load("<?php echo $web;?>/php/load_posts.php",{action:item,limit:0, user:'<?php echo $row_u['id'];?>'});
                if(item=='post'){
                    $('.profile-choose-collaboration').removeClass('select');
                    $('#profile-choose-collaboration').attr('src','https://png.icons8.com/windows/100/bbbbbb/groups.png');
                    $('.profile-choose-post').addClass('select');
                    $('#profile-choose-post').attr('src','https://png.icons8.com/ios-glyphs/90/000000/menu.png')
                }else{
                    $('.profile-choose-collaboration').addClass('select');
                    $('#profile-choose-collaboration').attr('src','https://png.icons8.com/windows/100/000000/groups.png');
                    $('.profile-choose-post').removeClass('select');
                    $('#profile-choose-post').attr('src','https://png.icons8.com/ios-glyphs/90/bbbbbb/menu.png')
                }


            });


        </script>


        <div id="body-post" class="body" style="width: 100%; margin-top: 10px; left:0;">
            <?php

            $stmt = $db->prepare("SELECT 
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date, 
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
                                HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                AND nick_name = ?
                                ORDER BY posts.date DESC");

            $stmt->bind_param("ssss",$_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_GET['user']);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);
            if($num_rows==0){
                echo '<div id="content-empty">
                         '.$lang['user_posts'].'  <br>  
                        <img src="https://png.icons8.com/ios-glyphs/90/000000/sad.png">                
                        </div>
                    ';
            }
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


            <?php

           /* $stmt = $db->prepare("SELECT posts.id,posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date, posts.distance, posts.points, posts.time, posts.activity, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                        CASE WHEN EXISTS(SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'liked',
                                        CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'bookmark',
                                        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                        FROM users_in_collab
                                        INNER JOIN collaboration ON collaboration.id = users_in_collab.id_collaboration
                                        INNER JOIN posts ON posts.id = collaboration.id_post
                                        INNER JOIN users ON users.id = posts.id_user
                                        LEFT JOIN comments ON comments.id_post = posts.id
                                        WHERE users_in_collab.id_user = ?
                                        GROUP BY posts.id 
                                        HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                        ORDER BY posts.date DESC");

            $stmt->bind_param("ssss",$_SESSION['id'], $_SESSION['id'], $row_u['id'],$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);
            if($num_rows==0){
                echo '<div id="content-empty">
                         '.$lang['user_posts'].'  <br>  
                        <img src="https://png.icons8.com/ios-glyphs/90/000000/sad.png">                
                        </div>
                    ';
            }
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
            }*/
            ?>




        <div id="alerts">
            <?php require '../php/alerts.php'; ?>
        </div>

        <div id="alerts-2">

        </div>

        <?php require '../html/modals.html'; ?>


        <div id="overlay" class="md-overlay"></div>
        <script src="<?php echo $web ?>/js/classie.js"></script>
        <script src="<?php echo $web ?>/js/modalEffects.js"></script>
        <script src="<?php echo $web ?>/js/comments.js"></script>
        <script src="<?php echo $web ?>/js/post-more.js"></script>
        <script src="<?php echo $web ?>/js/like.js"></script>
        <script src="<?php echo $web; ?>/js/load-theme.js"></script>
        <script src="<?php echo $web; ?>/js/alerts-main.js"></script>
    </body>
</html>
