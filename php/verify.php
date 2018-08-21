<?php
    session_start();
    require '../config/db.php';
    $verify = 0;
    $verify2 = 1;

    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ? AND hash = ? AND verify = ?");
        $stmt->bind_param("ssi", $_GET['email'],$_GET['hash'],$verify);
        $stmt->execute();

        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            if($row['count']>0){
                $stmt = $db->prepare("UPDATE users SET verify= ? WHERE email = ?");
                $stmt->bind_param("is",$verify2, $_GET['email']);
                $stmt->execute();

                $hash2 = sha1( rand(0,9000000) );
                $stmt2 = $db->prepare("UPDATE users SET hash= ? WHERE email = ?");
                $stmt2->bind_param("ss",$hash2, $_GET['email']);
                $stmt2->execute();

                $_SESSION['alerts'] = "success:4";
                header("location: ../welcome");
            }else{
                $_SESSION['alerts'] = "error:8";
                header("location: ../welcome");
            }
        }
    }