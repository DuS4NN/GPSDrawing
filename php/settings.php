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
            if(!isset($_POST['f_name']) || empty($_POST['f_name']) || !isset($_POST['l_name']) || empty($_POST['l_name'])
            || !isset($_POST['nick']) || empty($_POST['nick']) || !isset($_POST['email']) || empty($_POST['email']) ||
                !isset($_POST['night_mode']) || !isset($_POST['about']) ){
                echo '<div class="alert error remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error14'].'</div>';
                return;
            }

            if($_SESSION['nickname'] != $_POST['nick']){
                if(!preg_match("/^[a-zA-Z0-9-.*_]+$/",$_POST['nick'])==1){
                    echo '<div class="alert info alert-remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['error10'].'</div>';
                    return;
                }
            }

            if($_POST['email'] != $_SESSION['email']){
                $verify = 0;
                $hash = sha1( rand(0,9000000));
                $stmt = $db->prepare("UPDATE users SET hash= ? WHERE id = ?");
                $stmt->bind_param("ss",$hash, $_SESSION['id']);
                $stmt->execute();

                $_SESSION['verify'] = $verify;

                $to = $_POST['email'];
                $subject = 'Account Verification';
                $headers = 'From: info@GPSDrawing.com';
                $message =  '
                Hello '.$_POST['f_name'].',
        
                Please click this link to activate your account:
        
                http://localhost/GPSDrawing/php/verify.php?email='.$_POST['email'].'&hash='.$hash;

                mail( $to, $subject, $message, $headers);

                echo '<div class="alert info alert-remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info13'].'</div>';

            }else{
                $verify = $_SESSION['verify'];
            }
            $stmt =  $db->prepare("UPDATE `users` 
                      SET 
                      email = ?, 
                      nick_name = ?, 
                      first_name = ?, 
                      last_name = ?,
                      about = ?,
                      verify = ?
                      WHERE id = ? ");
            $stmt->bind_param("sssssss", $_POST['email'], $_POST['nick'], $_POST['f_name'], $_POST['l_name'], $_POST['about'],$verify,$_SESSION['id']);
            $stmt->execute();

            $stmt2 = $db->prepare("
                    UPDATE `users_options` 
                      SET 
                      night_mode = ?
                      WHERE `users_options`.`id_user` = ?");
            $stmt2->bind_param("ss", $_POST['night_mode'],$_SESSION['id']);
            $stmt2->execute();

            $_SESSION['email'] = $_POST['email'];
            $_SESSION['nickname'] = $_POST['nick'];
            $_SESSION['night_mode'] = $_POST['night_mode'];

            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span> '.$lang['info12'].'</div>';
            echo "<script> ".$_SESSION['nickname']."</script>";
            break;
    }