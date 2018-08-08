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
        <link rel="stylesheet" href="https://afeld.github.io/emoji-css/emoji.css" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
        <script src="<?php echo $web ?>/js/load-map.js"></script>

    </head>

    <body>
        <?php require '../html/header.html'; ?>

        <?php
            $stmt = $db->prepare("SELECT users.id, nick_name, about, first_name, last_name, date, profile_picture, aa.collabcount,
                                        CASE WHEN EXISTS(SELECT * FROM followers WHERE followers.id_user = users.id  AND followers.follower = ?)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'follow',
                                        CASE WHEN EXISTS(SELECT * FROM blocked_users WHERE blocked_users.blocked = users.id  AND user_id = ?)
                                            THEN '1'
                                            ELSE '0'
                                            END AS 'blocked',
                                        (SELECT COUNT(id) FROM posts WHERE posts.id_user = users.id) as 'postscount',
                                        (SELECT COUNT(*) FROM `followers`  INNER JOIN users ON followers.id_user = users.id WHERE users.nick_name = ?)  as 'followcount'
                                        
                                        FROM users
                                        JOIN (SELECT COUNT(DISTINCT id_collaboration) as collabcount 
                                        FROM users_in_collab 
                                        INNER JOIN users ON users.id = users_in_collab.id_user
                                            WHERE users_in_collab.id_collaboration
                                            NOT IN (SELECT collaboration 
                                                FROM posts 
                                                INNER JOIN users ON users.id = posts.id_user
                                                WHERE users.nick_name = ?)) aa
                                        WHERE nick_name = ?");
            $stmt->bind_param("sssss",$_SESSION['id'], $_SESSION['id'], $_GET['user'], $_GET['user'], $_GET['user']);
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
            <?php

            if($row_u['blocked']=='1'){
                  echo '
                <div id="blocked">
                    <div style="width: 50%;margin-top:150px;margin-left:auto;margin-right:auto;text-align: left">
                          <span style="margin-left: 200px"></span>           
                    </div>
                </div>
                ';
            }

            ?>
            <div id="profile-info">
                <div id="profile-info-nick">
                    <h5><?php echo $row_u['nick_name'];?></h5><?php if($row_u['blocked']=='1') exit();  ?> <img class="md-trigger" id="<?php echo $row_u['id'];?>" data-modal="<?php if($row_u['id']==$_SESSION['id'])echo 'modal-8'; else echo 'modal-7'; ?>" src="<?php echo $web; ?>/img/more.png" />
                </div>
                <div id="profile-info-name">
                    <?php echo $row_u['first_name']. ' '. $row_u['last_name']; ?>
                </div>
                <div id="profile-info-about">
                    <?php echo $row_u['about']; ?>
                </div>


            </div>
            <div id="profile-follow">
                <?php if($row_u['id']!=$_SESSION['id']) {
                    if($row_u['follow']==1){
                        echo '<input onmousedown="return false;" onselectstart="return false;" onclick=follow('.$row_u["id"].') class="profile-follow-button follow" value="'.$lang['following'].'">';
                    }else{
                        echo '<input onmousedown="return false;" onselectstart="return false;" onclick=follow('.$row_u['id'].') class="profile-follow-button" type="button" value="'.$lang['follow'].'">';
                    }
                }
                ?>

            </div>
        </div>

        <div id="profile-badges">
            <div class="left" id="profile-scroll">
                <img src="https://png.icons8.com/ios/96/000000/back.png">
            </div>

            <div id="profile-badges-content">
                <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/1.png"> <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/3.png">
                <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/2.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/4.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/5.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/6.png">
                <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/7.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/8.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/9.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/10.png">
                <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/11.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/12.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/13.png"><img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/14.png">
                <img class="profile-badges-img" src="<?php echo $web; ?>/img/badge/15.png">
            </div>


            <div class="right" id="profile-scroll">
                <img src="https://png.icons8.com/ios/96/000000/forward.png">
            </div>
        </div>




        <div id="profile-stats">
            <div id="profile-stat-item" class="first">
                <img src="https://png.icons8.com/windows/80/1ab188/map.png"> <?php echo $lang['posts'];?>: <br> <span class="profile-stat-item-numbers"><?php echo $row_u['postscount'];?></span>
            </div>
            <div id="profile-stat-item" class="center">
                <img src="https://png.icons8.com/windows/96/1ab188/conference-call.png"> <?php echo $lang['followers'];?>: <br> <span id="profile-stat-item-numbers-followers" class="profile-stat-item-numbers"><?php echo $row_u['followcount']; ?></span>
            </div>
            <div id="profile-stat-item">
                <img src="https://png.icons8.com/windows/64/1ab188/collaboration.png"> <?php echo $lang['collaborations'];?>: <br> <span class="profile-stat-item-numbers"><?php echo $row_u['collabcount'];?></span>
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

        <div id="alerts">
            <?php require '../php/alerts.php'; ?>
        </div>

        <div id="alerts-2">

        </div>

        <?php require '../html/modals.html'; ?>



        <script>

            var sirka = ($(window).width()/100)*54;
            var pocet = parseInt((sirka)/120);
            var medzera = parseInt((sirka-(100*pocet))/pocet);

            $('.profile-badges-img').css('margin-left',medzera/2);
            $('.profile-badges-img').css('margin-right',medzera/2);

            $('#profile-scroll.left').click(function () {

                var sirka = ($(window).width()/100)*54;
                var pocet = parseInt((sirka)/120);
                var medzera = parseInt((sirka-(100*pocet))/pocet);
                var scroll = medzera+100;

                $('#profile-badges-content').animate({
                    scrollLeft: '-='+scroll
                },500, 'easeOutQuad');
            });

            $('#profile-scroll.right').click(function () {

                var sirka = ($(window).width()/100)*54;
                var pocet = parseInt((sirka)/120);
                var medzera = parseInt((sirka-(100*pocet))/pocet);
                var scroll = medzera+100;

                $('#profile-badges-content').animate({
                    scrollLeft: '+='+scroll
                },500, 'easeOutQuad');
            });
        </script>

        <div id="overlay" class="md-overlay"></div>
        <script src="<?php echo $web ?>/js/classie.js"></script>
        <script src="<?php echo $web ?>/js/profile-actions.js"></script>
        <script src="<?php echo $web ?>/js/modalEffects.js"></script>
        <script src="<?php echo $web ?>/js/comments.js"></script>
        <script src="<?php echo $web ?>/js/post-more.js"></script>
        <script src="<?php echo $web ?>/js/like.js"></script>
        <script src="<?php echo $web ?>/js/follow.js"></script>
        <script src="<?php echo $web; ?>/js/load-theme.js"></script>
        <script src="<?php echo $web; ?>/js/alerts-main.js"></script>
    </body>
</html>
