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
                                        CASE WHEN notification.action = 1 OR notification.action = 3
                                        THEN (SELECT posts.id_user FROM posts WHERE id = notification.post_user_id)
                                        ELSE notification.post_user_id
                                        END AS 'idto'
                                        FROM notification
                                        INNER JOIN users ON users.id = notification.id_user
                                        HAVING idto = ? ORDER BY notification.id DESC LIMIT 8");
            $stmt->bind_param("i", $_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_rows = mysqli_num_rows($result);
            $count = 0;
            while ($row = $result->fetch_assoc()){
                echo '
                    <div id="nav-notif-item"';
                if($count==0)echo ' class="first"';
                echo '">
                        <div id="nav-notif-image">
                             <a href = "'.$web.'/user/'.$row['nick_name'].'"><div id="nav-search-item-img" style="background-image: url( '.$web.'/'.$row['profile_picture'].'"></div></a>
                        </div> 
                        
                        <div id="nav-notif-content">
                            <div id="nav-notif-nick"><a href ="'.$web.'/user/'.$row['nick_name'].'">'.$row['nick_name'].'</a></div>';
                
                            echo '
                            <a href="'.$web.'/';

                            if($row['action']==1 || $row['action']==3)echo 'post/'.$row['post_user_id'];
                            else if($row['action']==2 || $row['action']==4)echo 'user/'.$row['nick_name'];


                            echo '"><div id="nav-notif-text">'.$lang['notif'.$row['action']].'</div>

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

                            echo '</div></a>

                        </div>
                    </div>';
                $count++;
            }
            break;
    }