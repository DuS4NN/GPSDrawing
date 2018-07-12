<?php
    session_start();
    require '../config/db.php';

    $password = sha1($_POST['password']);
    $email = $_POST['email'];

    $stmt = $db->prepare("SELECT COUNT(*) AS count, verify, id, nick_name FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        if($row['count']>0){
            if($row['verify']==1){
                $_SESSION['email'] = $email;
                $_SESSION['nickname'] = $row['nickname'];
                $_SESSION['id'] = $row['id'];
                echo "<script>localStorage.setItem('id','".$row['id']."'); </script>";
                header("location: ../home");
            }else{
                //error unverify email
                $_SESSION['alerts'] = "error:2";
                header("location: ../welcome");
            }
        }else{
            //eror wrong email or password
            $_SESSION['alerts'] = "error:1";
            header("location: ../welcome");
        }
    }