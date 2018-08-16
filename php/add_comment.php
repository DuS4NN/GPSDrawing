<?php
    require '../config/db.php';
    require '../config/lang.php';
    session_start();

    if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['text']) || !isset($_SESSION['id']) || empty($_SESSION['id'])){
        echo $_POST['id']." ".$_POST['text']." ".$_SESSION['id'];
        return;
    }

    $id = $_POST['id'];
    $text = $_POST['text'];

    date_default_timezone_set('UTC');
    $date = date("Y-m-d H:i");

    $stmt = $db->prepare("INSERT INTO comments (id_user, id_post, comment, time) VALUES (?,?,?,?)");
    $stmt->bind_param("iiss", $_SESSION['id'], $id, $text, $date);
    $stmt->execute();

    $lastID = mysqli_insert_id($db);

    $stmt = $db->prepare("SELECT comments.id as 'comid', comments.id_user, comments.id_post, comments.comment, comments.time, users.nick_name, 
                    CASE WHEN EXISTS (SELECT * FROM comments WHERE comments.id_user = ? AND comments.id = comid) 
                    THEN '1' 
                    ELSE '0'
                    END AS 'commented'
                    FROM comments 
                    INNER JOIN users ON users.id = comments.id_user                
                    WHERE  comments.id = ?");
    $stmt->bind_param("ii", $_SESSION['id'],$lastID);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        include("../html/comment.php");
}