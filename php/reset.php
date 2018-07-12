<?php
    require '../config/db.php';

    if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = $_GET['email'];
        $hash = $_GET['hash'];

        $stmt = $db->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ? AND hash = ?");
        $stmt->bind_param("ss",$email,$hash);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            if($row['count']>0){
                include("../html/reset.php");
            }else{
                session_start();
                $_SESSION['alerts'] = "error:6";
                header("location:  ../welcome");
            }
        }

    }