<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_POST['action']) || empty($_POST['action'])){
        return;
    }

    $action = $_POST['action'];

    switch ($action){
        case 1:
            if(isset($_POST['nick']) && !empty($_POST['nick'])){
                $nick1 = "%".$_POST['nick']."%";
                $nick2 =  $_POST['nick']."%";
                $nick3 = "%".$_POST['nick'];


                $query = "SELECT
                          users.nick_name, users.profile_picture
                          FROM users
                          WHERE users.nick_name LIKE ?
                          AND users.id NOT IN (SELECT blocked FROM blocked_users WHERE blocked_users.id = ?)
                          ORDER BY
                          CASE
                            WHEN nick_name LIKE ? THEN 1
                            WHEN nick_name LIKE ? THEN 3
                          ELSE 2
                          END
                          LIMIT 8";
                $stmt = $db->prepare($query);
                $stmt->bind_param("ssss", $nick1,$_SESSION['id'],$nick2, $nick3);
                $stmt->execute();
                $result = $stmt->get_result();
                $num_rows = mysqli_num_rows($result);
                if ($num_rows == 0) {
                    echo '<div id="search-user-empty">
                          ' . $lang['error11'] . '               
                         </div>';
                }else{
                    $count = 0;
                    while ($row = $result->fetch_assoc()){
                        echo '<a href="'.$web.'/user/'.$row['nick_name'].'"><div id="nav-search-item"';
                        if($count==0)echo ' class="first"';
                                echo '>
                                <div id="nav-search-item-img" style="background-image: url( '.$web.'/'.$row['profile_picture'].'"></div>
                                <div id="nav-search-item-nick">'.$row['nick_name'].'</div>
                                </div><a>';
                        $count++;
                    }
                }

            }
            break;
        case 2:
            $stmt = $db->prepare("SELECT notification.*, users.nick_name, users.profile_picture,
                                        CASE WHEN notification.action = 1 OR notification.action = 3 OR notification.action = 5 OR notification.action = 6
                                        THEN (SELECT posts.id_user FROM posts WHERE id = notification.post_user_id)
                                        ELSE notification.post_user_id
                                        END AS 'idto'
                                        FROM notification
                                        INNER JOIN users ON users.id = notification.id_user
                                        HAVING idto = ?
                                        AND (idto != id_user OR action = 4)
                                        ORDER BY notification.id DESC LIMIT ?,8");
            $stmt->bind_param("is", $_SESSION['id'],$_POST['limit']);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);
            $count = 0;
            while ($row = $result->fetch_assoc()){
                echo '
                    <div id="nav-notif-item"';
                if($count==0 && $_POST['limit']==0 && $row['view']==0)echo ' class="first unseen"';
                else if($count==0 && $_POST['limit']==0)echo ' class="first"';
                else if($row['view']==0)echo 'class="unseen"';

                echo '>
                        <a href = "'.$web.'/user/'.$row['nick_name'].'"><div id="nav-notif-image">
                             <div id="nav-search-item-img" style="background-image: url( '.$web.'/'.$row['profile_picture'].'"></div>
                        </div></a>';
                
                            echo '
                            <a href="'.$web.'/';

                            if($row['action']==1 || $row['action']==3 || $row['action']==5 || $row['action']==6)echo 'post/'.$row['post_user_id'];
                            else if($row['action']==2 || $row['action']==4)echo 'user/'.$row['nick_name'];



                            echo '">
                                 <div id="nav-notif-content">
                            <div id="nav-notif-nick">'.$row['nick_name'].'</div>

                            <div id="nav-notif-text">'.$lang['notif'.$row['action']].'</div>

                           <div id="nav-notif-time">';

                            $date = $row['date'];
                            $newd = date_create_from_format('Y-m-d H:i',$date);
                            $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                            $time = time();


                            //echo date("Y-m-d H:i", $milisec);
                            if($time-$milisec<0){
                                echo '1 '.$lang['sec'].'.';
                            }else if($time-$milisec<60){
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

                            echo '</div>

                        </div></a>
                    </div>';
                $count++;
            }

            $stmt = $db->prepare("UPDATE notification SET view = 1 WHERE view = 0 AND notification.id IN (SELECT id FROM (SELECT id,
                                            CASE WHEN notification.action = 1 OR notification.action = 3 OR notification.action = 5 OR notification.action = 6
                                              THEN (SELECT posts.id_user FROM posts WHERE id = notification.post_user_id)
                                              ELSE notification.post_user_id
                                              END AS 'idto'
                                            FROM notification
                                            HAVING idto = ?) as aa
                                            )");
            $stmt->bind_param("i", $_SESSION['id']);
            $stmt->execute();
            break;
        case 3:
            $query = "  SELECT notification.id, notification.action, notification.id_user,
                        CASE WHEN notification.action = 1 OR notification.action = 3 OR notification.action = 5 OR notification.action = 6
                        THEN (SELECT posts.id_user FROM posts WHERE id = notification.post_user_id)
                        ELSE notification.post_user_id
                        END AS 'idto'
                        FROM notification
                        WHERE view = 0
                        HAVING idto = ?
                        AND (idto != id_user OR action = 4)
                        ";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i",$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);

            echo 'row_count_notification:'.$num_rows;

            break;
    }