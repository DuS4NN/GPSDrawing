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
        <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
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
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
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
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                           <input type="text" required class="profile f-name" name="f-name" value="<?php echo $row['first_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['last_name']; ?></div>
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile l-name" name="l-name" value="<?php echo $row['last_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['nick_name']; ?></div>
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile nick" name="nick" value="<?php echo $row['nick_name']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text" class="profile">
                            <div id="title"><?php echo $lang['email_address']; ?></div>
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
                            <input type="text" required class="profile email" name="email" value="<?php echo $row['email']?>">
                        </div>
                    </div>

                    <div id="container-item">
                        <div id="container-item-text">
                            <div id="title"><?php echo $lang['night_mode']; ?></div>
                            <div id="small-title"><?php echo $lang['multi_color_lines_desc']; ?></div>
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
                            <div id="small-title"><?php echo $lang['icons_desc']; ?></div>
                        </div>
                        <div id="container-item-sett" class="profile">
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
                    Password
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
                <!-- EDIT MAP hotovo--->
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
                    users
                </div>

                <div id="container-blocked-posts" class="container-right ">
                    posts
                </div>

                <div id="container-blocked-comments" class="container-right ">
                    Com
                </div>


            </div>
        </div>





        <script>
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
        <script src="<?php echo $web ?>/js/load-theme.js"></script>

    </body>
</html>
