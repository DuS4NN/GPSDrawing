<?php
    session_start();
    require '../config/db.php';


    if(!isset($_POST['password']) || empty($_POST['password']) || !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['nickname']) || empty($_POST['nickname']) || !isset($_POST['firstname']) || empty($_POST['firstname']) || !isset($_POST['lastname']) || empty($_POST['lastname'])){
        header("location: ../welcome");
        return;
    }

    $first_name = $_POST['firstname'];
    $last_name =  $_POST['lastname'];
    $nick_name = $_POST['nickname'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $hash = sha1( rand(0,9000000) );
    $profilepicture = "img/profilepicture.png";

    $checkemail = true;
    $checknickname = true;

    //Check if email exists
    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        if($row['count']>0){
            $_SESSION['alerts'] = "error:4";
            header("location: ../welcome");
            $checkemail = false;
            return;
        }
    }

    //Check if nickname exists
    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users where nick_name = ?");
    $stmt->bind_param("s", $nick_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        if($row['count']>0){
            $_SESSION['alerts'] = "error:3";
            header("location: ../welcome");
            $checknickname = false;
            return;
        }
    }

    //Add user
    if($checkemail == true && $checknickname == true){
        $stmt = $db->prepare("INSERT INTO users (email, nick_name, first_name, last_name, profile_picture, password, hash) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $email, $nick_name, $first_name, $last_name, $profilepicture, $password, $hash);
        $stmt->execute();

        $lastID = mysqli_insert_id($db);

        $stmt = $db->prepare("INSERT INTO users_options (id_user) VALUES (?)");
        $stmt->bind_param("i", $lastID);
        $stmt->execute();




        //Send verify email
        $to = $email;
        $subject = 'Account Verification';
        $headers = 'From: info@GPSDrawing.com';
        $message =  '
            Hello '.$first_name.',
    
            Thank you for signing up!
    
            Please click this link to activate your account:
    
            http://localhost/GPSDrawing/php/verify.php?email='.$email.'&hash='.$hash;

        mail( $to, $subject, $message, $headers);
        $_SESSION['alerts'] = "success:1";
        header("location: ../welcome");

    }
