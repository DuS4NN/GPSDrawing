<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) ){
        echo 'das';
        return;
    }

    $id = $_POST['id'];

    switch ($_POST['action']){
        case 0:
            $_SESSION = array();
            // Swipe via memory
            if (ini_get("session.use_cookies")) {
                // Prepare and swipe cookies
                $params = session_get_cookie_params();
                // clear cookies and sessions
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            // Just in case.. swipe these values too
            ini_set('session.gc_max_lifetime', 0);
            ini_set('session.gc_probability', 1);
            ini_set('session.gc_divisor', 1);
            // Completely destroy our server sessions..
            session_destroy();
            $_SESSION = [];
            break;
        case 1:
            if(isset($_POST['reason'])){
                $stmt = $db->prepare("INSERT INTO `reported_users` (`user_id`, `reported`, reason) VALUES (?, ?, ?);");
                $stmt->bind_param("iis", $_SESSION['id'],$id, $_POST['reason']);
                $stmt->execute();
                echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info5'].'</div>';
            }
            break;
        case 2:
            if($id == $_SESSION['id']){
                return;
            }

            date_default_timezone_set('UTC');
            $date = date("Y-m-d H:i");

            $stmt = $db->prepare("INSERT INTO `blocked_users` (`user_id`, `blocked`, `date` ) VALUES (?, ?, ?);");
            $stmt->bind_param("iis", $_SESSION['id'],$id, $date);
            $stmt->execute();
            $_SESSION['alerts'] = "info:11";
            break;
    }