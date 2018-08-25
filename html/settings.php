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
        <title><?php echo $lang['settings'] ?></title>
        <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/settings.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all">
        <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
        <script src="<?php echo $web ?>/js/load-theme.js"></script>
        <script src="<?php echo $web ?>/js/load-map.js"></script>
        <script src="<?php echo $web ?>/js/alerts-main.js"></script>
    </head>

    <body>
        <?php require '../html/header.html'; ?>


        <?php
        $stmt = $db->prepare("SELECT
                                    color, color_of_collab, night_mode, show_icons, map_theme, color_icon, users.password, users.nick_name,
                                    users.first_name, users.last_name, users.profile_picture, users.email, users.about
                                    FROM users
                                    INNER JOIN users_options ON users.id = users_options.id_user
                                    WHERE users.id = ?");
        $stmt->bind_param("i",$_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


        ?>

        <div id="settings-container">
            <div id="settings-nav-bar">
                <ul>
                    <li id="nav-edit-profile" class="nav-bar selected"><span class="fas fa-user-edit"></span> <?php echo $lang['edit_profile']; ?></li>
                    <li id="nav-change-password" class="nav-bar"><span class="fas fa-key"></span> <?php echo $lang['change_password']; ?></li>
                    <li id="nav-change-theme" class="nav-bar"><span class="fas fa-map"></span> <?php echo $lang['change_theme']; ?></li>
                    <li id="nav-edit-map" class="nav-bar"><span class="fas fa-map-marked-alt"></span> <?php echo $lang['edit_map']; ?></li>
                    <li id="nav-blocked-users" class="nav-bar"><span class="fas fa-user-lock"></span> <?php echo $lang['blocked_users']; ?></li>
                    <li id="nav-blocked-posts" class="nav-bar"><span class="fas fa-exclamation-triangle"></span> <?php echo $lang['blocked_posts']; ?></li>
                    <li id="nav-blocked-comments" class="nav-bar"><span class="fas fa-minus-circle"></span> <?php echo $lang['blocked_comments']; ?></li>
                </ul>
            </div>

            <div id="settings-content">
                <!-- EDIT PROFILE--->
                <div id="container-edit-profile" class="container-right select">

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['picture']; ?></div>
                            <div id="small-title"><?php echo $lang['picture_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">


                            <div style="width: 40px;margin-left:10px;float:left;">
                                <div id="profile-img" style="background-image: url(<?php echo $web ?>/<?php echo $row['profile_picture'] ?>)">

                                </div>

                            </div>

                            <div style="width: 150px;float:left;padding-top: 20px">
<!--- FOOOOOORM------------------>
                                <form enctype="multipart/form-data" action="<?php echo $web?>/php/change-profiledata.php" method="post" id="uploadform">
                                    <label class="custom-file-upload">
                                        <input name="upload-file" id="upload-file" accept=".jpg, .jpeg, .png,.bmp ,.gif" type="file"/>
                                        <?php echo $lang['browse']; ?>
                                    </label>
                            </div>
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['first_name']; ?></div>
                            <div id="small-title"><?php echo $lang['fname_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                           <input type="text" required class="profile f-name" name="f-name" value="<?php echo $row['first_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['last_name']; ?></div>
                            <div id="small-title"><?php echo $lang['lname_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile l-name" name="l-name" value="<?php echo $row['last_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['nick_name']; ?></div>
                            <div id="small-title"><?php echo $lang['nick_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile nick" name="nick" value="<?php echo $row['nick_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['email_address']; ?></div>
                            <div id="small-title"><?php echo $lang['email_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile email" name="email" value="<?php echo $row['email']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text">
                            <div id="title"><?php echo $lang['night_mode']; ?></div>
                            <div id="small-title"><?php echo $lang['night_mode_desc']; ?></div>
                        </div>
                        <div id="container-item-sett">
                            <div id="container-toggle-button" class="night_mode button<?php echo $row['night_mode']; ?>">
                                <div id="container-toogle-circle"></div>
                            </div>
                        </div>
                    </div>

                    <div id="container-item" class="profile-textarea">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['description']; ?></div>
                            <div id="small-title"><?php echo $lang['about_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile textarea">
                            <textarea name="about" maxlength="230" class="profile about"><?php echo $row['about']?></textarea>
                        </div>
                    </div>

                    <div id="container-button">
                        <button type="submit" name="submit" id="profile-save" class="profile-button"><?php echo $lang['save']; ?></button>
                    </div>

                    </form>



                </div>
                <!-- CHANGE PASSWORD--->

                <div id="container-change-password" class="container-right">
                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['old_password']; ?></div>
                            <div id="small-title"><?php echo $lang['old_password_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="password" required class="profile old_password" name="old-pass">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['new_password']; ?></div>
                            <div id="small-title"><?php echo $lang['new_password_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="password" minlength="5" required class="profile new_password" name="new-pass">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['confirm_password']; ?></div>
                            <div id="small-title"><?php echo $lang['confirm_password_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="password" minlength="5" required class="profile confirm_password" name="confirm-pass">
                        </div>
                    </div>


                    <div id="container-button">
                        <button class="change-password-button"><?php echo $lang['save']; ?></button>
                    </div>

                </div>
                <!-- CHANGE THEME--->
                <div id="container-change-theme" class="container-right">
                   <?php
                   $stmt = $db->prepare("SELECT id, name FROM map_theme");
                   $stmt->execute();
                   $result2 = $stmt->get_result();
                   $num_rows = mysqli_num_rows($result2);
                   $class= "";
                   for($i=1;$i<=$num_rows;$i++){
                       $row_mt = $result2->fetch_assoc();
                       if($row['map_theme']==$row_mt['id']){
                           $class = "selected";
                       }else{
                           $class= "";
                       }
                       if($i%2!=0){
                           echo '<div id="map-item-left" class="'.$class.'"> 
                                    <div class="settings-map" id="settings-map'.$row_mt['id'].'">
                                        <img src="'.$web.'/img/load.png" onload="initMap2('.$row_mt['id'].')">
                                    </div>
                                    <div id="map-item-title">'.$row_mt['name'].'</div>
                                </div>';
                       }else{
                           echo '<div id="map-item-right" class="'.$class.'"> 
                                     <div class="settings-map" id="settings-map'.$row_mt['id'].'">
                                        <img src="'.$web.'/img/load.png" onload="initMap2('.$row_mt['id'].')">
                                    </div>
                                    <div id="map-item-title">'.$row_mt['name'].'</div>
                                </div>';
                       }

                   }


                   ?>
                </div>
                <!-- EDIT MAP--->
                <div id="container-edit-map" class="container-right">

                    <div id="container-item">
                        <div id="container-item-text">
                            <div id="title"><?php echo $lang['color']; ?></div>
                            <div id="small-title"><?php echo $lang['color_desc']; ?></div>
                        </div>
                        <div id="container-item-sett">
                            <input id="styleInput" class="jscolor{valueElement:'valueInput', styleElement:'styleInput'} color-picker"  onmousedown="return false;" onselectstart="return false;">
                            <input id="valueInput" onmousedown="return false;" onselectstart="return false;" value="<?php echo $row['color']?>">
                        </div>
                    </div>

                   <div id="container-item">
                       <div id="container-item-text">
                           <div id="title"><?php echo $lang['multi_color_lines']; ?></div>
                           <div id="small-title"><?php echo $lang['multi_color_lines_desc']; ?></div>
                       </div>
                       <div id="container-item-sett">
                           <div id="container-toggle-button" class="collab button<?php echo $row['color_of_collab']; ?>">
                                <div id="container-toogle-circle"></div>
                           </div>
                       </div>
                   </div>

                    <div id="container-item">
                        <div id="container-item-text">
                            <div id="title"><?php echo $lang['icons']; ?></div>
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett">
                            <div id="container-toggle-button" class="icons button<?php echo $row['show_icons'];?>">
                                <div id="container-toogle-circle"></div>
                            </div>
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text">
                            <div id="title"><?php echo $lang['color_of_icon']; ?></div>
                            <div id="small-title"><?php echo $lang['color_of_icon_desc']; ?></div>
                        </div>
                        <div id="container-item-sett">
                            <input id="styleInput2" class="jscolor{valueElement:'valueInput2', styleElement:'styleInput2'} color-picker"  onmousedown="return false;" onselectstart="return false;">
                            <input id="valueInput2" onmousedown="return false;" onselectstart="return false;" value="<?php echo $row['color_icon']?>">
                        </div>
                    </div>

                    <div id="container-button">
                        <button class="edit-map-button"><?php echo $lang['save']; ?></button>
                    </div>
                </div>
            <!-- BLOCKED USERS--->
                <div id="container-blocked-users" class="container-right ">
                    <?php
                        $stmt = $db->prepare("SELECT blocked_users.id, blocked_users.date, users.nick_name,
                                                    (SELECT COUNT(*) FROM blocked_users WHERE user_id = ?) as count
                                                    FROM blocked_users
                                                    INNER JOIN users ON users.id = blocked_users.blocked
                                                    WHERE user_id = ? ORDER BY blocked_users.date DESC LIMIT 10");
                        $stmt->bind_param("ii",$_SESSION['id'], $_SESSION['id']);
                        $stmt->execute();
                        $result3 = $stmt->get_result();
                        $num_rows = mysqli_num_rows($result3);
                        $count = 0;
                        if($num_rows==0){
                            echo '<div id="content-empty">'.$lang['no_blocked_users'].'</div>';
                        }else{
                            while($row_bu = $result3->fetch_assoc()){
                                $count = $row_bu['count'];
                                echo '<div id="blocked-users-item" class="blocked-users-'.$row_bu['id'].'">    
                                    <div id="blocked-users-nick">
                                    '.$row_bu['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-users-date">
                                    '.$row_bu['date'].'
                                    </div>
                                    
                                    <div class="blocked-users-x"  id="'.$row_bu['id'].'">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
                            };
                            if($count>10){
                                echo '
                             <br>
                            <div id="blocked-users-arrows">
                                <div id="previous" class="blocked-users-previous">
                                    <span class="fas fa-chevron-left user disable"></span>
                                </div>
                                <div id="next" class="blocked-users-next">
                                    <span class="fas fa-chevron-right user '; if($count<=10)echo 'disable'; echo ' "></span>
                                </div>
                            </div>';
                            }

                        }
                    ?>
                </div>

                <div id="container-blocked-posts" class="container-right ">
                    <?php
                    $stmt = $db->prepare("SELECT blocked_posts.id, posts.description, users.nick_name,
                                                      (SELECT COUNT(*) FROM blocked_posts WHERE blocked_posts.id_user = ?) as count
                                                    FROM blocked_posts
                                                    INNER JOIN posts ON posts.id = blocked_posts.id_post
                                                    INNER JOIN users ON posts.id_user = users.id
                                                    WHERE blocked_posts.id_user = ? LIMIT 10");
                    $stmt->bind_param("ii",$_SESSION['id'],$_SESSION['id']);
                    $stmt->execute();
                    $result5 = $stmt->get_result();
                    $num_rows = mysqli_num_rows($result5);
                    $count = 0;

                    if($num_rows==0){
                        echo '<div id="content-empty">'.$lang['no_blocked_posts'].'</div>';
                    }else{
                        while($row_bp = $result5->fetch_assoc()){
                            $count = $row_bp['count'];
                            echo '<div id="blocked-posts-item" class="blocked-posts-'.$row_bp['id'].'">    
                                    <div id="blocked-posts-nick">
                                    '.$row_bp['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-posts-desc">';
                                    if(strlen($row_bp['description'])>=30){
                                        echo mb_substr($row_bp['description'],0,30,'utf-8')."..";
                                    }else{
                                        echo $row_bp['description'];
                                    }
                                    echo '</div>
                                    
                                    <div class="blocked-posts-x"  id="posts-'.$row_bp['id'].'">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
                        };
                        if($count>10){

                            echo '
                             <br>
                            <div id="blocked-posts-arrows">
                                <div id="previous" class="blocked-posts-previous">
                                    <span class="fas fa-chevron-left posts disable"></span>
                                </div>
                                <div id="next" class="blocked-comments-next">
                                    <span class="fas fa-chevron-right posts'; if($count<=10)echo 'disable'; echo ' "></span>
                                </div>
                            </div>';
                        }

                    }
                    ?>
                </div>

                <div id="container-blocked-comments" class="container-right ">
                    <?php
                    $stmt = $db->prepare("SELECT blocked_comments.id as 'comid', blocked_comments.id_comment, comments.id_user, SUBSTRING(comments.comment,1,30) as comment, users.nick_name,
                                                (SELECT COUNT(*) FROM blocked_comments WHERE id_user = ?) as count
                                                FROM blocked_comments
                                                INNER JOIN comments ON comments.id = blocked_comments.id_comment
                                                INNER JOIN users ON users.id = comments.id_user
                                                WHERE blocked_comments.id_user = ? LIMIT 10");
                    $stmt->bind_param("ii",$_SESSION['id'],$_SESSION['id']);
                    $stmt->execute();
                    $result4 = $stmt->get_result();
                    $num_rows = mysqli_num_rows($result4);
                    $count = 0;

                    if($num_rows==0){
                        echo '<div id="content-empty">'.$lang['no_blocked_comments'].'</div>';
                    }else{
                        while($row_bc = $result4->fetch_assoc()){
                            $count = $row_bc['count'];
                            echo '<div id="blocked-comments-item" class="blocked-comments-'.$row_bc['comid'].'">    
                                    <div id="blocked-comments-nick">
                                    '.$row_bc['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-comments-comment">
                                    ';
                            if(strlen($row_bc['comment'])>=30){
                                echo mb_substr($row_bc['comment'],0,30,'utf-8')."..";
                            }else{
                                echo $row_bc['comment'];
                            }

                            echo '
                                    </div>
                                    
                                    <div class="blocked-comments-x"  id="comments-'.$row_bc['comid'].'">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
                        };
                        if($count>10){

                            echo '
                             <br>
                            <div id="blocked-comments-arrows">
                                <div id="previous" class="blocked-comments-previous">
                                    <span class="fas fa-chevron-left comment disable"></span>
                                </div>
                                <div id="next" class="blocked-comments-next">
                                    <span class="fas fa-chevron-right comment'; if($count<=10)echo 'disable'; echo ' "></span>
                                </div>
                            </div>';
                        }

                    }
                    ?>
                </div>
            </div>
        </div>





        <script>
            //post
            var blocked_posts = 0;
            $(document).on('click','.blocked-posts-x',function () {
                let id = $(this).attr('id').split("-")[1];
                $('.blocked-posts-'+id).css('display','none');
                $.ajax({
                    type:"POST",
                    url: localStorage.getItem("web")+"/php/settings.php",
                    data: {action:8,id: id},
                    success: function(response){
                        let alertSection = document.getElementById("alerts-2");
                        let text = alertSection.innerHTML;
                        alertSection.innerHTML = text + response;
                        closeAlert('remove');
                    }
                });
                setTimeout(function () {
                    $("#container-blocked-posts").load("<?php echo $web?>/php/settings.php",{action:7,limit:0});
                    blocked_posts=0;
                },200);
            });


            $(document).on('click','.fa-chevron-left.posts',function () {
                if($('.fa-chevron-left.comment').hasClass('disable')) return;
                blocked_posts-=10;

                $("#container-blocked-comments").load("<?php echo $web?>/php/settings.php",{action:7,limit:blocked_posts});
            });
            $(document).on('click','.fa-chevron-right.posts',function () {
                if($('.fa-chevron-right.comment').hasClass('disable')) return;
                blocked_posts+=10;

                $("#container-blocked-comments").load("<?php echo $web?>/php/settings.php",{action:7,limit:blocked_posts});
            });

            //COMMENT
            var blocked_comments = 0;
            $(document).on('click','.blocked-comments-x',function () {
                let id = $(this).attr('id').split("-")[1];
                $('.blocked-comments-'+id).css('display','none');
                $.ajax({
                    type:"POST",
                    url: localStorage.getItem("web")+"/php/settings.php",
                    data: {action:6,id: id},
                    success: function(response){
                        let alertSection = document.getElementById("alerts-2");
                        let text = alertSection.innerHTML;
                        alertSection.innerHTML = text + response;
                        closeAlert('remove');
                    }
                });
                setTimeout(function () {
                    $("#container-blocked-comments").load("<?php echo $web?>/php/settings.php",{action:5,limit:0});
                    blocked_comments=0;
                },200);
            });


            $(document).on('click','.fa-chevron-left.comment',function () {
                if($('.fa-chevron-left.comment').hasClass('disable')) return;
                blocked_comments-=10;

                $("#container-blocked-comments").load("<?php echo $web?>/php/settings.php",{action:5,limit:blocked_comments});
            });
            $(document).on('click','.fa-chevron-right.comment',function () {
                if($('.fa-chevron-right.comment').hasClass('disable')) return;
                blocked_comments+=10;

                $("#container-blocked-comments").load("<?php echo $web?>/php/settings.php",{action:5,limit:blocked_comments});
            });


            //USERS
            var blocked_users = 0;
            $(document).on('click','.blocked-users-x',function () {
               let id = $(this).attr('id');
               $('.blocked-users-'+id).css('display','none');
                $.ajax({
                    type:"POST",
                    url: localStorage.getItem("web")+"/php/settings.php",
                    data: {action:4,id: id},
                    success: function(response){
                        let alertSection = document.getElementById("alerts-2");
                        let text = alertSection.innerHTML;
                        alertSection.innerHTML = text + response;
                        closeAlert('remove');
                    }
                });

                setTimeout(function () {
                    $("#container-blocked-users").load("<?php echo $web?>/php/settings.php", {action: 3,limit: 0});
                    blocked_users=0;
                },200);


            });


            $(document).on('click','.fa-chevron-left.user',function () {
                if($('.fa-chevron-left.user').hasClass('disable')) return;
                blocked_users-=10;
                console.log(blocked_users);
                $("#container-blocked-users").load("<?php echo $web?>/php/settings.php",{action:3,limit:blocked_users});
            });
            $(document).on('click','.fa-chevron-right.user',function () {
                if($('.fa-chevron-right.user').hasClass('disable')) return;
                blocked_users+=10;
                console.log(blocked_users);
                $("#container-blocked-users").load("<?php echo $web?>/php/settings.php",{action:3,limit:blocked_users});
            });

            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------
            //-----------------------------------------------------------------------------------------------------------------



            $(document).on('click','.change-password-button', function () {
                let old_pass = $('.old_password').val();
                let new_pass = $('.new_password').val();
                let confirm_pass = $('.confirm_password').val();

                $.ajax({
                    type:"POST",
                    url: localStorage.getItem("web")+"/php/settings.php",
                    data: {action: 2,old_pass: old_pass, new_pass: new_pass, confirm_pass: confirm_pass},
                    success: function(response){
                        let alertSection = document.getElementById("alerts-2");
                        let text = alertSection.innerHTML;
                        alertSection.innerHTML = text + response;
                        closeAlert('remove');
                    }
                });

            });

            $('#upload-file').on('change',function () {
                let fileInput = document.getElementById('upload-file');
                let fileName = fileInput.value.split(/(\\|\/)/g).pop();

                if(!fileName.endsWith('.jpg') && !fileName.endsWith('.jpeg') && !fileName.endsWith('.bmp') && !fileName.endsWith('.png') && !fileName.endsWith('.gif')){
                    document.getElementById('upload-file').value = "";
                    return;
                }

                if(fileInput.files && fileInput.files[0]){
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        console.log("dsadas");
                        $("#profile-img").css('background-image', "url("+e.target.result+")");
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $(document).on('click', '#container-toggle-button',function () {
                if($(this).hasClass('button0')) $(this).removeClass('button0').addClass('button1');
                else $(this).removeClass('button1').addClass('button0');
            });

            $(document).on('click','.edit-map-button', function () {
                let color = "#"+$('#valueInput').val();
                let collab;
                let icon;
                let color_icon = "#"+$('#valueInput2').val();
                if($('.collab').hasClass('button0')) collab = 0; else collab = 1;
                if($('.icons').hasClass('button0')) icon = 0; else icon = 1;

                $.ajax({
                    type:"POST",
                    url: localStorage.getItem("web")+"/php/settings.php",
                    data: {action: 1,color: color, collab: collab, icon: icon, color_icon: color_icon},
                    success: function(response){
                        let alertSection = document.getElementById("alerts-2");
                        let text = alertSection.innerHTML;
                        alertSection.innerHTML = text + response;
                        closeAlert('remove');
                    }
                });

            });

            $('.nav-bar').click(function () {
                $('.selected').removeClass('selected');
                $(this).addClass('selected');
                let id = $(this).attr('id').replace('nav','container');
                $('.select').removeClass('select');
                $("#"+id).addClass('select');

                $("#settings-container").css('height','fit-content');
            });
        </script>

        <div id="alerts-2" class="settings">
            <?php require '../php/alerts.php'; ?>
        </div>

        <script src="<?php echo $web ?>/js/color-pixer.js"></script>


    </body>
</html>
