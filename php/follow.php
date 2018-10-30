<?php
    session_start();
    require '../config/db.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['action']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    $action = $_POST['action'];
    $id = $_POST['id'];

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");


    if($action==1){
        if($id==$_SESSION['id'])return;
        $stmt = $db->prepare("INSERT INTO `followers` (`follower`, `id_user`, `date`) VALUES (?, ?, ?);");
        $stmt->bind_param("iis", $_SESSION['id'],$id, $date);
        $stmt->execute();

        $action=2;$view=0;
        $stmt = $db->prepare("INSERT INTO `notification` (`id_user`, `action`, `post_user_id`, `view`,`date`) VALUES (?,?,?,?,?);");
        $stmt->bind_param("iiiis", $_SESSION['id'],$action,$id,$view,$date);
        $stmt->execute();

        $stmt = $db->prepare("INSERT INTO users_badges (user_id, badge_id, date)
                                        SELECT
                                            ?,
                                            (SELECT
                                                 CASE
                                                    WHEN (SELECT COUNT(*) FROM followers WHERE id_user=1) >= 1000
                                                     THEN '13'
                                                     WHEN (SELECT COUNT(*) FROM followers WHERE id_user=1) >= 100
                                                     THEN '9'
                                                      WHEN (SELECT COUNT(*) FROM followers WHERE id_user=1) >= 20
                                                     THEN '5'
                                                  END as 'badge_id'
                                            ) as bb,
                                            ?
                                        FROM dual
                                        HAVING NOT EXISTS(SELECT * FROM users_badges WHERE user_id = ? AND badge_id = bb)
                                        AND bb IS NOT NULL;
                                    ");
        $stmt->bind_param("isi",$id,$date, $id);
        $stmt->execute();


    }else{
        $stmt = $db->prepare("DELETE FROM followers WHERE follower = ? AND id_user = ?");
        $stmt->bind_param("ii", $_SESSION['id'],$id);
        $stmt->execute();
    }