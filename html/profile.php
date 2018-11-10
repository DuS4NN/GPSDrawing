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
        <title><?php echo $lang['profile'] ?></title>
        <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/profile.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
        <?php if($_SESSION['night_mode']==1)echo '<link rel="stylesheet" href="'.$web.'/css/dark_mode.css">';?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>

        <script src="<?php echo $web; ?>/js/load-theme.js"></script>
        <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&language=<?php echo $_SESSION['lang']?>"></script>
        <script src="<?php echo $web ?>/js/load-map.js"></script>
        <script src="<?php echo $web ?>/js/alerts-main.js"></script>

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
                                                        WHERE users.nick_name = ?
                                                        )
                                                AND users.nick_name = ?
                                               ) aa
                                          WHERE nick_name = ?
                                        
                                        
                                        ");
            $stmt->bind_param("ssssss",$_SESSION['id'], $_SESSION['id'], $_GET['user'], $_GET['user'], $_GET['user'],$_GET['user'] );
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);
            $row_u = $result->fetch_assoc();

            if($row_u==0){
                echo '<div id="content-empty" class="profile">'.$lang['error11'].'</div>';
                exit();
            }

            $stmt = $db->prepare("SELECT badges.name, badges.rarity, badges.url
                                        FROM users_badges 
                                        INNER JOIN badges ON badges.id = users_badges.badge_id
                                        WHERE users_badges.user_id = ?
                                        ORDER BY badges.rarity");
            $stmt->bind_param("i",$row_u['id']);
            $stmt->execute();
            $result3 = $stmt->get_result();

            ?>

        <script>
            document.title = "<?php echo $row_u['nick_name'];?>";
        </script>

        <div id="profile" >
            <div id="profile-image-profile">
                <div id="profile-image" style="background-image: url(<?php echo $web ?>/<?php echo $row_u['profile_picture'] ?>)">
                </div>

                <div id="profile-info-date">

                    <?php
                    echo $lang['since'].' ';
                    $date = $row_u['date'];
                    $newd = date_create_from_format('Y-m-d H:i',$date);
                    $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                    $time = time();

                    if($_SESSION['lang']=='sk'){
                        setlocale(LC_TIME, 'sk-SK');
                    }else{
                        setlocale(LC_TIME, 'en-EN');
                    }

                    //echo date("Y-m-d H:i", $milisec);
                    if($time-$milisec<60){
                        echo intval(($time-$milisec)).' '.$lang['sec'].'.';
                    }else if($time-$milisec<3600){
                        echo intval(($time-$milisec)/60) . ' min.';
                    }else if($time-$milisec<86400){
                        echo intval(($time-$milisec)/3600).' '.$lang['hod'].'.';
                    }else if($time-$milisec<2592000){
                        echo utf8_encode(ucwords(strftime("%#d. %b %H:%M",$milisec)));

                    }else{
                        $date1 = date("Y",$time);
                        $date2 = date("Y",$milisec);
                        if($date1==$date2){
                            echo utf8_encode(ucwords(strftime("%#d. %b",$milisec)));
                        }else{
                            echo utf8_encode(ucwords(strftime("%#d. %b %Y",$milisec)));
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
                    <h5><?php echo $row_u['nick_name'];?></h5><?php if($row_u['blocked']=='1') exit();  ?> <img class="md-trigger" id="<?php echo $row_u['id'];?>" data-modal="<?php if($row_u['id']==$_SESSION['id'])echo 'modal-8'; else echo 'modal-7'; ?>" src="https://png.icons8.com/android/96/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; ?>/more.png" />
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
                }else{
                        echo '<form action="';echo $web; echo'/add">
                               <input onmousedown="return false;" onselectstart="return false;" value="'; echo $lang['add_post'];  echo'" class="add_new_post" type="submit">
                              </form>';
                }
                ?>

            </div>
        </div>

        <div id="profile-badges">
            <div class="left" id="profile-scroll">
                <img src="https://png.icons8.com/ios/96/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; ?>/back.png">
            </div>

            <div id="profile-badges-content">

                <?php
                    while($row_b = $result3->fetch_assoc()){
                        echo '<img class="profile-badges-img" title="'.$lang[$row_b['name']].'" src="'.$web.$row_b['url'].'">';
                    }
                ?>

            </div>

            <div class="right" id="profile-scroll">
                <img src="https://png.icons8.com/ios/96/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; ?>/forward.png">
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
                <div id="profile-choose-item" class="profile-choose-post select" item="post"><img id="profile-choose-post" src="https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '1ab188'; else echo '1ab188'; ?>/menu.png"> <?php echo $lang['users_posts'];?></div>
                <div id="profile-choose-item" class="profile-choose-collaboration" item="collaboration"> <img id="profile-choose-collaboration" src="https://png.icons8.com/windows/100/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/groups.png"> <?php echo $lang['collaborations'];?></div>
            </div>
        </div>

        <script>
            var old_item = "post";
            let limit = 5;
            $(document).on('click','#profile-choose-item',function () {

                let item = $(this).attr('item');
                if(old_item==item){
                    return;
                }
                window.scrollTo(0,0);
                limit = 5;
                old_item=item;



                    if(old_item==='post'){
                        $('.profile-choose-collaboration').removeClass('select');
                        $('#profile-choose-collaboration').attr('src','https://png.icons8.com/windows/100/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/groups.png');
                        $('.profile-choose-post').addClass('select');
                        $('#profile-choose-post').attr('src','https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '1ab188'; else echo '1ab188'; ?>/menu.png')
                    }else{
                        $('.profile-choose-collaboration').addClass('select');
                        $('#profile-choose-collaboration').attr('src','https://png.icons8.com/windows/100/<?php if($_SESSION['night_mode']==1)echo '1ab188'; else echo '1ab188'; ?>/groups.png');
                        $('.profile-choose-post').removeClass('select');
                        $('#profile-choose-post').attr('src','https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/menu.png')
                    }

                setTimeout(function () {
                    $.ajax({
                        type:"POST",
                        url: "<?php echo $web; ?>/php/load_posts.php",
                        data:{action:old_item,limit:0,end_limit:5,collab:<?php echo $row_u['collabcount']?>, user:'<?php echo $row_u['id'];?>'},
                        success:function(response){
                            document.getElementById("body").innerHTML = response;
                            new MeteorEmoji();
                        }
                    });
                },0);
                $(window).bind('scroll DOMMouseScroll', onscroll);

            });



            function getDocHeight() {
                let D = document;
                return Math.max(
                    D.body.scrollHeight, D.documentElement.scrollHeight,
                    D.body.offsetHeight, D.documentElement.offsetHeight,
                    D.body.clientHeight, D.documentElement.clientHeight
                )-150;
            }

            let click = true;
            function onscroll() {
                if(!click){
                    return;
                }

                if($(window).scrollTop() + window.innerHeight >= getDocHeight()) {
                    setTimeout(function () {
                        $.ajax({
                            type:"POST",
                            url: "<?php echo $web; ?>/php/load_posts.php",
                            data:{action:old_item,limit:limit,end_limit:1,collab:<?php echo $row_u['collabcount']?>, user:'<?php echo $row_u['id'];?>'},
                            success:function(response){
                                $("#body").append(response);
                                new MeteorEmoji();
                                if(response.length<200){
                                    $(window).unbind('scroll DOMMouseScroll', onscroll);
                                }
                            }
                        });
                        limit++;
                        click=false;
                        setTimeout(function () {
                            click=true;
                        },100);
                    },0);
                }
            }


            $(window).on('scroll DOMMouseScroll', onscroll);
        </script>


        <div id="body" class="body" style="width: 100%; margin-top: 10px; left:0;">

            <script>
            $.ajax({
                type:"POST",
                url: "<?php echo $web; ?>/php/load_posts.php",
                data:{action:'post',limit:0,end_limit:5,collab:<?php echo $row_u['collabcount']?>, user:'<?php echo $row_u['id'];?>'},
                success:function(response){
                    $("#body").append(response);
                    new MeteorEmoji();
                    if(response.length<200){
                        $(window).unbind('scroll DOMMouseScroll', onscroll);
                    }
                }
            });
            </script>

        </div>

        <div id="alerts-2">
            <?php require '../php/alerts.php'; ?>
        </div>

        <?php require '../html/modals.html'; ?>



        <script>

            var sirka = ($(window).width()/100)*54;
            var img,img_medzera;
            if(sirka<=638.3 && sirka>405){
                img = 80;
                img_medzera=10;
            }else if(sirka<=405){
                img = 50;
                img_medzera=1;
                sirka = ($(window).width()/100)*85;
            }else{
                img = 120;
                img_medzera=20
            }



            var pocet = parseInt((sirka)/img);
            var medzera = parseInt((sirka-((img-img_medzera)*pocet))/pocet);

            $('.profile-badges-img').css('margin-left',medzera/2);
            $('.profile-badges-img').css('margin-right',medzera/2);

            $('#profile-scroll.left').click(function () {

                var sirka = ($(window).width()/100)*54;
                var img,img_medzera;
                if(sirka<=638.3 && sirka>405){
                    img = 80;
                    img_medzera=10;
                }else if(sirka<=405){
                    img = 50;
                    img_medzera=4;
                    sirka = ($(window).width()/100)*85;
                }else{
                    img = 120;
                    img_medzera=20
                }
                var pocet = parseInt((sirka)/img);
                var medzera = parseInt((sirka-((img-img_medzera)*pocet))/pocet);
                var scroll = medzera+(img-img_medzera);

                $('#profile-badges-content').animate({
                    scrollLeft: '-='+scroll
                },300, 'easeOutQuad');
            });

            $('#profile-scroll.right').click(function () {

                var img,img_medzera;
                if(sirka<=638.3 && sirka>405){
                    img = 80;
                    img_medzera=10;
                }else if(sirka<=405){
                    img = 50;
                    img_medzera=4;
                    sirka = ($(window).width()/100)*85;
                }else{
                    img = 120;
                    img_medzera=20
                }
                var pocet = parseInt((sirka)/img);
                var medzera = parseInt((sirka-((img-img_medzera)*pocet))/pocet);
                var scroll = medzera+(img-img_medzera);

                $('#profile-badges-content').animate({
                    scrollLeft: '+='+scroll
                },300, 'easeOutQuad');
            });


            if (window.performance) {
                $( "body" ).scrollTop(0);
            }
        </script>
        <script src="<?php echo $web?>/js/meteorEmoji.min.js"></script>
        <script>
                new MeteorEmoji();
        </script>

        <div id="overlay" class="md-overlay"></div>
        <script src="<?php echo $web ?>/js/classie.js"></script>
        <script src="<?php echo $web ?>/js/profile-actions.js"></script>
        <script src="<?php echo $web ?>/js/modalEffects.js"></script>
        <script src="<?php echo $web ?>/js/comments.js"></script>
        <script src="<?php echo $web ?>/js/post-more.js"></script>
        <script src="<?php echo $web ?>/js/like.js"></script>
        <script src="<?php echo $web ?>/js/follow.js"></script>
        <script src="<?php echo $web; ?>/js/alerts-main.js"></script>
    </body>
</html>
