<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';


    if(!isset($_SESSION['id']) || empty($_SESSION['id']) || !isset($_POST['points']) || empty($_POST['points']) ||  !isset($_POST['radio'])){
        return;
    }

    if($_POST['radio'] != 0 && $_POST['radio'] != 1 && $_POST['radio'] != 2 && $_POST['radio'] != 3 ){
        $_POST['radio'] = 0;
    }

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");
    $collab =0;

    $stmt = $db->prepare("INSERT INTO posts (id_user, date, activity, description, points, collaboration, duration, length, place) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssssss", $_SESSION['id'], $date, $_POST['radio'], $_POST['desc'], $_POST['points'], $collab,$_POST['duration'],$_POST['length'],$_POST['place']);
    $stmt->execute();

    $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_id, date)
                                    SELECT
                                        ?,
                                        (SELECT
                                             CASE
                                                WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration=0) >= 100
                                                 THEN '11'
                                                 WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration=0) >= 50
                                                 THEN '7'
                                                  WHEN (SELECT COUNT(*) FROM posts WHERE id_user=? AND collaboration=0) >= 10
                                                 THEN '3'
                                              END as 'badge_id'
                                        ) as bb,
                                        ?
                                    FROM dual
                                    HAVING NOT EXISTS(SELECT * FROM users_badges WHERE user_id = ? AND badge_id = bb)
                                    AND bb IS NOT NULL;
                                ");
    $stmt->bind_param("iiiisi",$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$date, $_SESSION['id']);
    $stmt->execute();

    $_SESSION['alerts'] = "success:5";