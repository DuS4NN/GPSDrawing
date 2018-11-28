<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['newpassword']) || empty($_POST['newpassword']) || !isset($_POST['confirmpassword']) || empty($_POST['confirmpassword'])){
        return;
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['newpassword']==$_POST['confirmpassword']){
            $password = sha1($_POST['newpassword']);
            $email = $_POST['email'];
            $hash = $_POST['hash'];
            $stmt = $db->prepare("UPDATE users SET password=? WHERE email=? AND hash=?");
            $stmt->bind_param("sss",$password,$email,$hash);
            $stmt->execute();

            $hash2 = sha1( rand(0,9000000) );
            $stmt = $db->prepare("UPDATE users SET hash= ? WHERE email = ?");
            $stmt->bind_param("ss",$hash2, $email);
            $stmt->execute();


            $_SESSION['alerts'] = "success:3";
            header("location: ../welcome");
        }else{
            $_SESSION['alerts'] = "error:7";
            header("location: ../reset?email=".$_POST['email']."&hash=".$_POST['hash']);
        }
    }
