<?php
    session_start();
    require '../config/db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];

    $stmt = $db->prepare("SELECT COUNT(*) AS count, first_name FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        if($row['count']>0){
            $hash = sha1( rand(0,9000000) );
            $first_name = $row['first_name'];

            //Change hash
            $stmt = $db->prepare("UPDATE users SET hash= ? WHERE email = ?");
            $stmt->bind_param("ss",$hash, $email);
            $stmt->execute();


            //Send mail
            $to = $email;
            $subject = 'Password Reset Link';
            $headers = 'From: info@GPSDrawing.com';
            $message_body = '
					Hello '.$first_name.',

					You have requested password reset!

					Please click this link to reset your password:

					http://localhost/GPSDrawing/php/reset.php?email='.$email.'&hash='.$hash;

            mail($to, $subject, $message_body, $headers);

            $_SESSION['alerts'] = "success:2";
            header("location:  ../welcome");
        }else{
            $_SESSION['alerts'] = "error:5";
            header("location:  ../forgot");
        }
    }
}