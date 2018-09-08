<?php
    require '../config/db.php';
    require '../config/lang.php';
    session_start();

    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_POST['action'])){
        return;
    }

    switch ($_POST['action']) {
        case 1:
            if(!isset($_POST['name']) || empty($_POST['name'])){
                echo '<div class="alert warning remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error24'].'</div>';
                return;
            }

            $stmt =  $db->prepare("SELECT * FROM projects WHERE id_user = ?");
            $stmt->bind_param("i",$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>=20){
                echo '<div class="alert warning remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error25'].'</div>';
                return;
            }


            $stmt =  $db->prepare("INSERT INTO projects (`id_user`, `name`) VALUES (?, ?)");
            $stmt->bind_param("is",$_SESSION['id'],$_POST['name']);
            $stmt->execute();

            $lastID = mysqli_insert_id($db);


            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info19'].'</div>';
            echo 'ID-PROJECT:'.$lastID;
            break;
        case 2:
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $stmt =  $db->prepare("DELETE FROM projects WHERE id=? AND id_user=?");
                $stmt->bind_param("ii",$_POST['id'],$_SESSION['id']);
                $stmt->execute();
                echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info20'].'</div>';
            }
            break;
        case 3:
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $stmt =  $db->prepare("SELECT
                                                users_options.collab, posts.id_user, posts.collaboration,
                                                 CASE WHEN EXISTS (SELECT * FROM followers WHERE follower = posts.id_user AND followers.id_user = ?)
                                                  THEN '1'
                                                  ELSE '0'
                                                  END AS 'follower'
                                                FROM posts
                                                INNER JOIN users_options ON posts.id_user = users_options.id_user
                                                WHERE posts.id = ? ");
                $stmt->bind_param("ii",$_SESSION['id'],$_POST['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row['collaboration']!=0){
                    echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error27'].'</div>';
                    return;
                }

                if($row['id_user']==$_SESSION['id']){
                    echo 'SUCCESS:ADD:TO:PROJECT';
                    return;
                }

                if($row['collab']==1){
                    echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error26'].'</div>';
                    return;
                }else if($row['collab']==2 && $row['follower']==0){
                    echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error26'].'</div>';
                }else{
                    echo 'SUCCESS:ADD:TO:PROJECT';
                }

            }
            break;
        case 4:
            if(isset($_POST['id_project']) && !empty($_POST['id_project']) && isset($_POST['id_post']) && !empty($_POST['id_post'])){

                $stmt =  $db->prepare("SELECT
                                                users_options.collab, posts.id_user, posts.collaboration,
                                                (SELECT COUNT(*) FROM projects_posts WHERE id_project = ? GROUP BY id_project) as 'count',
                                                  (SELECT id FROM projects_posts WHERE id_project = ? AND id_post = ?) as 'exists',
                                                 CASE WHEN EXISTS (SELECT * FROM followers WHERE follower = posts.id_user AND followers.id_user = ?)
                                                  THEN '1'
                                                  ELSE '0'
                                                  END AS 'follower'
                                                FROM posts
                                                INNER JOIN users_options ON posts.id_user = users_options.id_user
                                                WHERE posts.id = ? ");
                $stmt->bind_param("iiiii",$_POST['id_project'],$_POST['id_project'],$_POST['id_post'],$_SESSION['id'],$_POST['id_post']);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $row_c = $result->fetch_assoc();

                if($row_c['exists']!=null){
                    echo '<div class="alert warning remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error28'].'</div>';
                    return;
                }

                if($row_c['count']>10){
                    echo '<div class="alert warning remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error29'].'</div>';
                    return;
                }


                if($row_c['id_user']==$_SESSION['id'] || $row_c['collaboration']!=0 || ($row_c['collab']==2 && $row_c['follower']==1) || $row_c['collab']==3){

                    $stmt2 = $db->prepare("INSERT INTO projects_posts (projects_posts.id_project, projects_posts.id_post) VALUES (?,?)");
                    $stmt2->bind_param("ss",$_POST['id_project'],$_POST['id_post']);
                    $stmt2->execute();

                    date_default_timezone_set('UTC');
                    $date = date("Y-m-d H:i");

                    $action=5;$view=0;
                    $stmt = $db->prepare("INSERT INTO `notification` (`id_user`, `action`, `post_user_id`, `view`, `date`) VALUES (?,?,?,?,?);");
                    $stmt->bind_param("iiiis", $_SESSION['id'],$action,$_POST['id_post'],$view,$date);
                    $stmt->execute();

                    echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info21'].'</div>';
                }
            }
            break;
        case 5:
            if(isset($_POST['id_project']) && !empty($_POST['id_project'])){

                $stmt = $db->prepare("SELECT projects_posts.*, users.nick_name, posts.points, projects.name
                                            FROM projects_posts
                                            INNER JOIN posts ON posts.id = projects_posts.id_post
                                            INNER JOIN users ON posts.id_user = users.id
                                            RIGHT JOIN projects ON projects.id = projects_posts.id_project
                                            WHERE projects.id = ?");
                $stmt->bind_param("i",$_POST['id_project']);
                $stmt->execute();

                $result = $stmt->get_result();
                $points = "";

                while ($row = $result->fetch_assoc()){
                    if($row['id']==null)return;

                    $points = $points.'*'.$row['nick_name'].'*'.$row['points'];
                }

                mysqli_data_seek($result, 0);
                $row = $result->fetch_assoc();

                include("../html/project-post.php");


               /* echo '
                    <div id="map'.$row['id_project'].'" class="map">
                        <img style="width: 1px; height: 1px" onload="initMap(\''.$row['id_project'].','.substr($points,1,strlen($points)).','.$_SESSION['color'].','.$_SESSION['color_of_collab'].','.$_SESSION['color_icon'].','.$_SESSION['show_icons'].','.$_SESSION['map_theme'].',1)" src="'.$web.'/img/load.png"/>
                    </div>';*/
            }
            break;
    }