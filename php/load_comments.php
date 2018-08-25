<?php

    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['num']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        return;
    }

    $id = $_POST['id'];
    $num = $_POST['num'];

    $stmt = $db->prepare("SELECT comments.id as 'comid', comments.id_user, comments.id_post, comments.comment, comments.time, users.nick_name, 
                    CASE WHEN EXISTS (SELECT * FROM comments WHERE comments.id_user = ? AND comments.id = comid) 
                    THEN '1' 
                    ELSE '0'
                    END AS 'commented'
                    FROM comments 
                    INNER JOIN users ON users.id = comments.id_user 
                    WHERE comments.id_post = ? 
                    AND comments.id NOT IN (SELECT id_comment FROM blocked_comments WHERE blocked_comments.id_user = ?)
                    AND comments.id_user NOT IN (SELECT blocked FROM blocked_users WHERE user_id = ?)
                    ORDER BY comments.time  
                    DESC LIMIT ?,5");
    $stmt->bind_param("iiiis", $_SESSION['id'], $id, $_SESSION['id'],$_SESSION['id'],$num);
    $stmt->execute();

    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        include("../html/comment.php");
    }

    $stmt = $db->prepare("SELECT COUNT(*) as 'count' FROM comments WHERE comments.id_post = ? 
                                AND comments.id NOT IN (SELECT id_comment FROM blocked_comments WHERE blocked_comments.id_user = ?)
                                 AND comments.id_user NOT IN (SELECT blocked FROM blocked_users WHERE user_id = ?)");
    $stmt->bind_param("iii", $id,$_SESSION['id'],$_SESSION['id']);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        if($row['count']-5<=$num){
            echo '<script>
                    var x = document.getElementById("loadmore-'.$id.'");
                   
                    x.style.display = "none";
                  </script>';
        }else{
            echo '<script>
                    var x = document.getElementById("loadmore-'.$id.'");
                   
                    x.style.display = "block";
                  </script>';
        }
    }