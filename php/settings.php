<?php
require '../config/db.php';
require '../config/lang.php';
session_start();

if(!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_POST['action'])){
    return;
}


switch ($_POST['action']){
    case 1:
        if(!isset($_POST['color']) || empty($_POST['color']) || !isset($_POST['collab']) || !isset($_POST['icon']) || !isset($_POST['color_icon']) || empty($_POST['color_icon'])){
            return;
        }
        $stmt =  $db->prepare("UPDATE `users_options` 
                      SET 
                      color = ?, 
                      color_of_collab = ?, 
                      show_icons = ?, 
                      color_icon = ?
                       WHERE `users_options`.`id_user` = ?");
        $stmt->bind_param("sssss", $_POST['color'], $_POST['collab'], $_POST['icon'], $_POST['color_icon'],$_SESSION['id']);
        $stmt->execute();

        $_SESSION['color'] = $_POST['color'];
        $_SESSION['color_of_collab'] = $_POST['collab'];
        $_SESSION['show_icons'] = $_POST['icon'];
        $_SESSION['color_icon'] = $_POST['color_icon'];

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info12'].'</div>';
        break;

    case 2:
        if(!isset($_POST['old_pass']) || empty($_POST['old_pass']) || !isset($_POST['new_pass']) || empty($_POST['new_pass']) || !isset($_POST['confirm_pass']) || empty($_POST['confirm_pass'])  ){
            echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error14'].'</div>';
            return;
        }

        if(strlen($_POST['new_pass'])<5){
            echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error23'].'</div>';
            return;
        }

        $old = sha1($_POST['old_pass']);
        $new = sha1($_POST['new_pass']);
        $confirm = sha1($_POST['confirm_pass']);

        if($new != $confirm){
            echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error21'].'</div>';
            return;
        }

        $stmt =  $db->prepare("SELECT * FROM users WHERE password = ? AND id = ?");
        $stmt->bind_param("ss", $old,$_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = mysqli_num_rows($result);

        if($num_rows==0){
            echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error22'].'</div>';
            return;
        }

        $stmt =  $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("ss", $new,$_SESSION['id']);
        $stmt->execute();

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info14'].'</div>';

        break;

    case 3:
        if(!isset($_POST['limit'])){
            return;
        }
        $stmt = $db->prepare("SELECT blocked_users.id, blocked_users.date, users.nick_name,
                                                    (SELECT COUNT(*) FROM blocked_users WHERE user_id = ?) as count
                                                    FROM blocked_users
                                                    INNER JOIN users ON users.id = blocked_users.blocked
                                                    WHERE user_id = ? LIMIT ?,10");
        $stmt->bind_param("iis",$_SESSION['id'], $_SESSION['id'],$_POST['limit']);
        $stmt->execute();
        $result3 = $stmt->get_result();
        $count = 0;
        $num_rows = mysqli_num_rows($result3);
        if($num_rows==0) {
            echo '<div id="content-empty">' . $lang['no_blocked_users'] . '</div>';
            return;
        }

        while($row_bu = $result3->fetch_assoc()){

            $count = $row_bu['count'];

            echo '<div id="blocked-users-item">    
                                    <div id="blocked-users-nick">
                                    '.$row_bu['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-users-date">
                                    '.$row_bu['date'].'
                                    </div>
                                    
                                    <div class="blocked-users-x">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
        };

        if($count>10){
            echo '<br><div id="blocked-users-arrows"><div id="previous" class="blocked-users-previous">';
            if($_POST['limit']>=10)echo'<span class="fas fa-chevron-left user"></span>';
            else echo'<span class="fas fa-chevron-left user disable"></span>';
            echo'</div><div id="next" class="blocked-users-next">';
            if($_POST['limit']+10>=$count)echo '<span class="fas fa-chevron-right user disable"></span>';
            else echo'<span class="fas fa-chevron-right user"></span>';
            echo '</div></div>';
        }

        break;

    case 4:
        if(!isset($_POST['id'])){
            return;
        }
        $stmt =  $db->prepare("DELETE FROM blocked_users WHERE id = ? and user_id = ?");
        $stmt->bind_param("ii", $_POST['id'],$_SESSION['id']);
        $stmt->execute();

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info15'].'</div>';

        break;

    case 5:
        if(!isset($_POST['limit'])){
            return;
        }
        $stmt = $db->prepare("SELECT blocked_comments.id as comid, blocked_comments.id_comment, comments.id_user,comments.comment as comment, users.nick_name,
                                                (SELECT COUNT(*) FROM blocked_comments WHERE id_user = ?) as count
                                                FROM blocked_comments
                                                INNER JOIN comments ON comments.id = blocked_comments.id_comment
                                                INNER JOIN users ON users.id = comments.id_user
                                                WHERE blocked_comments.id_user = ? LIMIT ?,10");
        $stmt->bind_param("iis",$_SESSION['id'],$_SESSION['id'],$_POST['limit']);
        $stmt->execute();
        $result3 = $stmt->get_result();
        $count = 0;
        $num_rows = mysqli_num_rows($result3);
        if($num_rows==0) {
            echo '<div id="content-empty">' . $lang['no_blocked_comments'] . '</div>';
            return;
        }

        while($row_bc = $result3->fetch_assoc()){

            $count = $row_bc['count'];

            echo '<div id="blocked-comments-item" class="blocked-comments-'.$row_bc['comid'].'">    
                                    <div id="blocked-comments-nick">
                                    '.$row_bc['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-comments-comment">
                                    ';
            echo $row_bc['comment'];


            echo '
                                    </div>
                                    
                                    <div class="blocked-comments-x"  id="comments-'.$row_bc['comid'].'">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
        };

        if($count>10){
            echo '<br><div id="blocked-comments-arrows"><div id="previous" class="blocked-comments-previous">';
            if($_POST['limit']>=10)echo'<span class="fas fa-chevron-left comment"></span>';
            else echo'<span class="fas fa-chevron-left comment disable"></span>';
            echo'</div><div id="next" class="blocked-comments-next">';
            if($_POST['limit']+10>=$count)echo '<span class="fas fa-chevron-right comment disable"></span>';
            else echo'<span class="fas fa-chevron-right comment"></span>';
            echo '</div></div>';
        }


        break;

    case 6:
        if(!isset($_POST['id'])){
            return;
        }
        $stmt =  $db->prepare("DELETE FROM blocked_comments WHERE id = ? and id_user = ?");
        $stmt->bind_param("ii", $_POST['id'],$_SESSION['id']);
        $stmt->execute();

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info16'].'</div>';

        break;

    case 7:
        if(!isset($_POST['limit'])){
            return;
        }
        $stmt = $db->prepare("SELECT blocked_posts.id, posts.description, users.nick_name,
                                                      (SELECT COUNT(*) FROM blocked_posts WHERE blocked_posts.id_user = ?) as count
                                                    FROM blocked_posts
                                                    INNER JOIN posts ON posts.id = blocked_posts.id_post
                                                    INNER JOIN users ON posts.id_user = users.id
                                                    WHERE blocked_posts.id_user = ? LIMIT ?,10");
        $stmt->bind_param("iis",$_SESSION['id'],$_SESSION['id'],$_POST['limit']);
        $stmt->execute();
        $result3 = $stmt->get_result();
        $count = 0;
        $num_rows = mysqli_num_rows($result3);
        if($num_rows==0) {
            echo '<div id="content-empty">' . $lang['no_blocked_posts'] . '</div>';
            return;
        }

        while($row_bc = $result3->fetch_assoc()){

            $count = $row_bc['count'];

            echo '<div id="blocked-posts-item" class="blocked-posts-'.$row_bc['id'].'">  
                                    <div id="blocked-posts-nick">
                                    '.$row_bc['nick_name'].'
                                    </div>
                                    
                                    <div id="blocked-posts-desc">';
            echo $row_bc['description'];

            echo '  </div>
                                    
                                    <div class="blocked-posts-x"  id="posts-'.$row_bc['id'].'">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>';
        };

        if($count>10){
            echo '<br><div id="blocked-posts-arrows"><div id="previous" class="blocked-posts-previous">';
            if($_POST['limit']>=10)echo'<span class="fas fa-chevron-left posts"></span>';
            else echo'<span class="fas fa-chevron-left posts disable"></span>';
            echo'</div><div id="next" class="blocked-posts-next">';
            if($_POST['limit']+10>=$count)echo '<span class="fas fa-chevron-right posts disable"></span>';
            else echo'<span class="fas fa-chevron-right posts"></span>';
            echo '</div></div>';
        }


        break;

    case 8:
        if(!isset($_POST['id'])){
            return;
        }
        $stmt =  $db->prepare("DELETE FROM blocked_posts WHERE id = ? and id_user = ?");
        $stmt->bind_param("ii", $_POST['id'],$_SESSION['id']);
        $stmt->execute();

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info17'].'</div>';

        break;

    case 9:
        if(!isset($_POST['id'])){
            return;
        }

        $stmt =  $db->prepare("UPDATE users_options SET map_theme = ? WHERE id_user = ?");
        $stmt->bind_param("ii", $_POST['id'],$_SESSION['id']);
        $stmt->execute();

        echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info18'].'</div>';

        $_SESSION['map_theme'] = $_POST['id'];
        break;

    case 10:
        if(isset($_POST['mode'])){
            $stmt =  $db->prepare("UPDATE users_options SET night_mode = ? WHERE id_user = ?");
            $stmt->bind_param("ii", $_POST['mode'],$_SESSION['id']);
            $stmt->execute();

            $_SESSION['night_mode'] = $_POST['mode'];
        }
        break;
}