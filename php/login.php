<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password'])){
        return;
    }

    $password = sha1($_POST['password']);
    $email = $_POST['email'];

    $stmt = $db->prepare("SELECT COUNT(*) AS count, verify, users.id, profile_picture, nick_name, users_options.color, users_options.show_icons,  
                                users_options.color_of_collab, users_options.lang, users_options.night_mode,users_options.map_theme, users_options.color_icon 
                                FROM users 
                                INNER JOIN users_options ON users_options.id_user = users.id 
                                WHERE users.email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        if($row['count']>0){
            if($row['verify']==1){
                $_SESSION['email'] = $email;
                $_SESSION['p_picture'] = $row['profile_picture'];
                $_SESSION['verify'] = $row['verify'];
                $_SESSION['nickname'] = $row['nick_name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['color'] = $row['color'];
                $_SESSION['show_icons'] = $row['show_icons'];
                $_SESSION['lang'] = $row['lang'];
                $_SESSION['color_of_collab'] = $row['color_of_collab'];
                $_SESSION['night_mode'] = $row['night_mode'];
                $_SESSION['map_theme'] = $row['map_theme'];
                $_SESSION['color_icon'] = $row['color_icon'];
                echo "<script> localStorage.setItem('id','".$row['id']."'); </script>";
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