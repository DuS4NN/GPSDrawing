<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';


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


            $stmt =  $db->prepare("INSERT INTO projects (id_user, name) VALUES (?, ?)");
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


                $stmt =  $db->prepare("DELETE FROM projects_posts WHERE projects_posts.id_project = ? AND projects_posts.id_user = ?");
                $stmt->bind_param("ii",$_POST['id'], $_SESSION['id']);
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

                    date_default_timezone_set('UTC');
                    $date = date("Y-m-d H:i");

                    $stmt2 = $db->prepare("INSERT INTO projects_posts (projects_posts.id_project, projects_posts.id_post, projects_posts.id_user, projects_posts.date) VALUES (?,?,?,?)");
                    $stmt2->bind_param("ssss",$_POST['id_project'],$_POST['id_post'],$_SESSION['id'],$date);
                    $stmt2->execute();

                    $action=5;$view=0;
                    $stmt = $db->prepare("INSERT INTO notification (id_user, action, post_user_id, view, date) VALUES (?,?,?,?,?);");
                    $stmt->bind_param("iiiis", $_SESSION['id'],$action,$_POST['id_post'],$view,$date);
                    $stmt->execute();

                    echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info21'].'</div>';
                }
            }
            break;
        case 5:
            if(isset($_POST['id_project']) && !empty($_POST['id_project'])){

                $stmt = $db->prepare("SELECT projects_posts.*,posts.id as postid, posts.description, users.nick_name, users.profile_picture, posts.points, projects.name
                                            FROM projects_posts
                                            INNER JOIN posts ON posts.id = projects_posts.id_post
                                            INNER JOIN users ON posts.id_user = users.id
                                            RIGHT JOIN projects ON projects.id = projects_posts.id_project
                                            WHERE projects.id = ?");
                $stmt->bind_param("i",$_POST['id_project']);
                $stmt->execute();

                $result = $stmt->get_result();
                $points = "";

                $project_id = 0;

                while ($row = $result->fetch_assoc()){
                    $points = $points.'*'.$row['nick_name'].'*'.$row['points'];
                }

                mysqli_data_seek($result, 0);
                $row = $result->fetch_assoc();

                echo '<div id="projects-content-title">
                        '.$lang['collaboration_project'].'
                      </div>';

                if($row['id']!=null){
                    $project_id = $row['id_project'];
                    include("../html/project-post.php");
                }else{
                    echo '<div class="map" id="settings-map'.$_SESSION['map_theme'].'">  <img src="'.$web.'/img/load.png" onload="initMap2('.$_SESSION['map_theme'].');"> </div>';
                }


                echo '<div id="projects-content-title">
                            '.$lang['posts_in_project'].'
                      </div>';

                mysqli_data_seek($result, 0);

                while($row = $result->fetch_assoc()){
                    if($row['id']==null)return;

                    echo '
                        <div id="projects-content-item" class="postid-'.$row['postid'].'">
                            <div id="projects-content-item-profile-picture"  style="background-image: url('.$web.'/'.$row['profile_picture'].')"></div>    
                            <div id="projects-content-item-nick"><a href="'.$web.'/user/'.$row['nick_name'].'">'.$row['nick_name'].'</a></div>
                            <div id="projects-content-post"><a href="'.$web.'/post/'.$row['postid'].'">
                             '.$row['description'].'
                            

                            </a></div>
                            
                            <div id="projects-content-delete"><span class="fas fa-times"></span></div>
                            
                            <div id="projects-content-date">';

                    $date = $row['date'];
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
                        echo'</div>
                        </div>
                    ';
                }
                echo '<div id="projects-content-button">

                        <button class="md-trigger" id="publish-projects-'.$project_id.'" data-modal="publish-projects">'.$lang['publish'].'</button>

                      </div>';

            }
            break;
        case 6:
            if(isset($_POST['id_project']) && !empty($_POST['id_project']) && isset($_POST['id_post']) && !empty($_POST['id_post'])){
                $stmt =  $db->prepare("DELETE FROM projects_posts WHERE id_user = ? AND id_project = ? AND id_post = ?");
                $stmt->bind_param("sss",$_SESSION['id'],$_POST['id_project'],$_POST['id_post']);
                $stmt->execute();

                echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info22'].'</div>';
            }
            break;
        case 7:
            if(isset($_POST['id_project']) && !empty($_POST['id_project']) && isset($_POST['activity']) && isset($_POST['desc'])){

                $stmt =  $db->prepare("INSERT INTO collaboration (id_post) VALUES (0)");
                $stmt->execute();
                $id_collaboration = mysqli_insert_id($db);

                $stmt =  $db->prepare("SELECT id_post, posts.id_user, posts.place, posts.duration, posts.length, users.nick_name,posts.points
                                                FROM projects
                                                INNER JOIN  projects_posts ON projects.id = projects_posts.id_project
                                                INNER JOIN posts ON posts.id = projects_posts.id_post
                                                INNER JOIN users ON posts.id_user = users.id
                                                WHERE projects.id = ?
                                                AND projects.id_user = ?");
                $stmt->bind_param("ss",$_POST['id_project'], $_SESSION['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $points="";
                $query = "INSERT INTO users_in_collab (id_collaboration, id_user) VALUES";

                $query_notif = "INSERT INTO notification (id_user, action, post_user_id, view, date) VALUES";

                date_default_timezone_set('UTC');
                $date = date("Y-m-d H:i");

                $duration=0;
                $length=0;
                $place="";

                while ($row = $result->fetch_assoc()){
                    $duration = $duration+$row['duration'];
                    $length =  $length+$row['length'];
                    $points = $points."*".$row['nick_name']."*".$row['points'];
                    $place = $row['place'];
                    $query = $query." (".$id_collaboration.",".$row['id_user']."),";

                    if($row['id_user']!=$_SESSION['id']){
                        $query_notif = $query_notif. " ('".$_SESSION['id']."','6','".$row['id_post']."','0','".$date."'),";
                    }
                }

                $query = substr($query,0,strlen($query)-1);
                $query_notif = substr($query_notif,0,strlen($query_notif)-1);

                //pridat post
                $stmt =  $db->prepare("INSERT INTO posts (id_user, date, description, activity, points, collaboration, duration, length, place) VALUES (?, ?, ?, ?, ?, ?,?,?,?)");
                $stmt->bind_param("issisiiis",$_SESSION['id'],$date, $_POST['desc'], $_POST['activity'], substr($points,1,strlen($points)), $id_collaboration,$duration,$length,$place);
                $stmt->execute();

                $id_post = mysqli_insert_id($db);

                $stmt =  $db->prepare($query_notif);
                $stmt->execute();

                $stmt =  $db->prepare($query);
                $stmt->execute();

                //pridat users in collab
                $stmt =  $db->prepare("UPDATE collaboration t SET t.id_post = ? WHERE t.id = ?");
                $stmt->bind_param("ss",$id_post,$id_collaboration);
                $stmt->execute();

                $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_id, date)
                                                SELECT
                                                    ?,
                                                    (SELECT
                                                         CASE
                                                            WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration!=0) >= 20
                                                             THEN '12'
                                                             WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration!=0) >= 10
                                                             THEN '8'
                                                              WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration!=0) >= 3
                                                             THEN '4'
                                                          END as 'badge_id'
                                                    ) as bb,
                                                    ?
                                                FROM dual
                                                HAVING NOT EXISTS(SELECT * FROM users_badges WHERE user_id = ? AND badge_id = bb)
                                                AND bb IS NOT NULL;");
                $stmt->bind_param("iiiisi",$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$date, $_SESSION['id']);
                $stmt->execute();

                $_SESSION['alerts'] = "info:23";
            }


            break;
    }