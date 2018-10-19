<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    if(!isset($_POST['f-name']) || empty($_POST['f-name']) || !isset($_POST['l-name']) || empty($_POST['l-name'])
        || !isset($_POST['nick']) || empty($_POST['nick']) || !isset($_POST['email']) || empty($_POST['email']) ||
        !isset($_POST['about']) ){
        $_SESSION['alerts'] = "info:14";
        header("location: ../settings");
        return;
    }

    if($_SESSION['nickname'] != $_POST['nick']){
        if(!preg_match("/^[a-zA-Z0-9-.*_]+$/",$_POST['nick'])==1){
            $_SESSION['alerts'] = "error:10";
            header("location: ../settings");
            return;
        }
    }


    if(isset($_FILES["upload-file"]["name"]) && !empty($_FILES["upload-file"]["name"])){
            if (!file_exists('../img/uploads/'.$_SESSION['id'])) {
                mkdir('../img/uploads/'.$_SESSION['id'], 0777, true);
            }


            $target_dir = "../img/uploads/".$_SESSION['id']."/";

            $files = glob($target_dir.'*'); // get all file names
            foreach($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }

            $target_file = $target_dir . basename($_FILES["upload-file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["upload-file"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $_SESSION['alerts'] = "error:15";
                    header("location: ../settings");
                    return;

                }
            }
            if (file_exists($target_file)) {
                $_SESSION['alerts'] = "error:16";
                header("location: ../settings");
                return;
            }
            if ($_FILES["upload-file"]["size"] > 500000) {
                $_SESSION['alerts'] = "error:17";
                header("location: ../settings");
                return;

            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $_SESSION['alerts'] = "error:18";
                header("location: ../settings");
                return;
            }

            if(strlen($_FILES["upload-file"]["name"])>100){
                $_SESSION['alerts'] = "error:20";
                header("location: ../settings");
                return;
            };

            if ($uploadOk != 0) {
                if (move_uploaded_file($_FILES["upload-file"]["tmp_name"], $target_file)) {
                    $url = "/img/uploads/".$_SESSION['id']."/".$_FILES["upload-file"]["name"];
                    $stmt = $db->prepare("UPDATE users SET profile_picture= ? WHERE id = ?");
                    $stmt->bind_param("ss",$url, $_SESSION['id']);
                    $stmt->execute();

                } else {
                    $_SESSION['alerts'] = "error:19";
                    header("location: ../settings");
                    return;
                }
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
                    Hello '.$_POST['f-name'].',
            
                    Please click this link to activate your account:
            
                    http://localhost/GPSDrawing/php/verify.php?email='.$_POST['email'].'&hash='.$hash;

        mail( $to, $subject, $message, $headers);
        $_SESSION['alerts'] = "info:13";


    }else{
        $_SESSION['alerts'] = "info:12";
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
    $stmt->bind_param("sssssss", $_POST['email'], $_POST['nick'], $_POST['f-name'], $_POST['l-name'], $_POST['about'],$verify,$_SESSION['id']);
    $stmt->execute();

    $stmt2 = $db->prepare("
                        UPDATE `users_options` 
                          SET 
                          lang = ?,
                          collab = ?
                          WHERE `users_options`.`id_user` = ?");

    $stmt2->bind_param("sss",$_POST['lang'],$_POST['collab'],$_SESSION['id']);
    $stmt2->execute();

    $_SESSION['lang'] = $_POST['lang'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['nickname'] = $_POST['nick'];


    header("location: ../settings");

