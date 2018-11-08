<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");

    $action = $_POST['action'];
    $id = $_POST['id'];

    if($action==0){
        $stmt = $db->prepare("INSERT INTO `likes` (id_user, `id_post`, `date` ) VALUES (?, ?, ?);");
        $stmt->bind_param("iis", $_SESSION['id'],$id,$date);
        $stmt->execute();

        $action=1;$view=0;
        $stmt = $db->prepare("INSERT INTO `notification` (`id_user`, `action`, `post_user_id`, `view`, `date`) VALUES (?,?,?,?,?);");
        $stmt->bind_param("iiiis", $_SESSION['id'],$action,$id,$view,$date);
        $stmt->execute();

        $stmt = $db->prepare("SELECT id_user FROM posts WHERE posts.id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $id_user = 0;
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()){
            $id_user = $row['id_user'];
        }

        $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_id, date)
                                    SELECT
                                        ?,
                                        (SELECT
                                             CASE
                                                WHEN (SELECT COUNT(*) FROM likes INNER JOIN posts ON posts.id = likes.id_post WHERE posts.id_user = ?) >= 50000
                                                 THEN '10'
                                                 WHEN (SELECT COUNT(*) FROM likes INNER JOIN posts ON posts.id = likes.id_post WHERE posts.id_user = ?) >= 10000
                                                 THEN '6'
                                                  WHEN (SELECT COUNT(*) FROM likes INNER JOIN posts ON posts.id = likes.id_post WHERE posts.id_user = ?) >= 1000
                                                 THEN '2'
                                              END as 'badge_id'
                                        ) as bb,
                                        ?
                                    FROM dual
                                    HAVING NOT EXISTS(SELECT * FROM users_badges WHERE user_id = ? AND badge_id = bb)
                                    AND bb IS NOT NULL;
                                ");
        $stmt->bind_param("iiiisi",$id_user,$id_user,$id_user,$id_user,$date, $id_user);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_id, date)
                                    SELECT
                                        ?,
                                        (SELECT
                                             CASE
                                                WHEN (SELECT COUNT(*) FROM likes WHERE likes.id_post = ?) >= 1000
                                                 THEN '24'
                                                 WHEN (SELECT COUNT(*) FROM likes WHERE likes.id_post = ?) >= 500
                                                 THEN '23'
                                                  WHEN (SELECT COUNT(*) FROM likes WHERE likes.id_post = ?) >= 1
                                                 THEN '22'
                                              END as 'badge_id'
                                        ) as bb,
                                        ?
                                    FROM dual
                                    HAVING NOT EXISTS(SELECT * FROM users_badges WHERE user_id = ? AND badge_id = bb)
                                    AND bb IS NOT NULL;
                                ");
        $stmt->bind_param("iiiisi",$id_user,$id,$id,$id,$date, $id_user);
        $stmt->execute();

    }else{
        $stmt = $db->prepare("DELETE FROM likes WHERE id_user = ? AND id_post = ?");
        $stmt->bind_param("ii", $_SESSION['id'],$id );
        $stmt->execute();
    }


