<?php

    session_start();
    require '../config/db.php';
    require '../config/lang.php';

    if(!isset($_POST['action']) || empty($_POST['action']) || !isset($_POST['limit'])){
        return;
    }

     $action = $_POST['action'];
     $limit = $_POST['limit'];


     switch ($action) {
         case 'post':
             if (!isset($_POST['user']) || empty($_POST['user'])) {
                 return;
             }
             $user = $_POST['user'];
             $query = "SELECT posts.id, posts.id_user as 'userid', users.profile_picture, posts.duration, posts.length, users.nick_name, posts.description, posts.date, 
                       posts.points, posts.activity, posts.collaboration, COUNT(comments.id) as 'countcomments',
                        CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id) 
                        THEN '1' 
                        ELSE '0'
                        END AS 'liked',
                        CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                        THEN '1'
                        ELSE '0'
                        END AS 'bookmark',
                        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                        FROM posts 
                        LEFT JOIN comments ON comments.id_post = posts.id 
                        INNER JOIN users ON users.id = posts.id_user 
                        WHERE users.id = ?
                        GROUP BY posts.id 
                        HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                        ORDER BY posts.date DESC LIMIT ?,?";
             $stmt = $db->prepare($query);
             $stmt->bind_param("ssisii", $_SESSION['id'], $_SESSION['id'], $user, $_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_posts'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png">                
                 </div>
             ';
             }
             break;
         case 'collaboration':
             if (!isset($_POST['user']) || empty($_POST['user'])) {
                 return;
             }
             $user = $_POST['user'];
             $query = "SELECT posts.id,posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date, posts.duration, posts.length, posts.points, posts.activity, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                 CASE WHEN EXISTS(SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                 THEN '1'
                                 ELSE '0'
                                 END AS 'liked',
                                 CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                 THEN '1'
                                 ELSE '0'
                                 END AS 'bookmark',
                                 (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                 FROM users_in_collab
                                 INNER JOIN collaboration ON collaboration.id = users_in_collab.id_collaboration
                                 INNER JOIN posts ON posts.id = collaboration.id_post
                                 INNER JOIN users ON users.id = posts.id_user
                                 LEFT JOIN comments ON comments.id_post = posts.id
                                 WHERE users_in_collab.id_user = ?  AND posts.id_user != ?
                                 GROUP BY posts.id 
                                 HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                 ORDER BY posts.date DESC LIMIT ?,?";
             $stmt = $db->prepare($query);
             $stmt->bind_param("ssiisii", $_SESSION['id'], $_SESSION['id'], $user, $user, $_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_collaboration'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>
             ';
             }
             break;
         case 'bookmarks_post':
             $stmt = $db->prepare("SELECT DISTINCTROW
                                posts.id, posts.id_user as 'userid', posts.description, posts.duration, posts.length, posts.date, posts.points, posts.activity, posts.collaboration,
                                users.profile_picture, users.nick_name,
                                COUNT(comments.id) as countcomments,
                                CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                THEN '1'
                                ELSE '0'
                                END AS 'liked',
                                CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                THEN '1'
                                ELSE '0'
                                END AS 'bookmark',
                                (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                FROM bookmarks
                                INNER JOIN posts ON bookmarks.id_post = posts.id
                                INNER JOIN users ON users.id = posts.id_user
                                LEFT JOIN comments ON comments.id_post = posts.id
                                WHERE bookmarks.id_user = ?
                                GROUP BY posts.id
                                
                                HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)
                                
                                ORDER BY bookmarks.id DESC
                                LIMIT ?,?;");

             $stmt->bind_param("sssssss",$_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'],$limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_bookmarks'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> </div>';
             }
             break;
         case 'following':
             $stmt = $db->prepare("SELECT
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, users.first_name, posts.description, posts.date,
                                posts.points, posts.activity, posts.duration, posts.length, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                  THEN '1'
                                  ELSE '0'
                                  END AS 'liked',
                                CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                  THEN '1'
                                  ELSE '0'
                                  END AS 'bookmark',
                                (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                FROM posts
                                LEFT JOIN comments ON comments.id_post = posts.id
                                INNER JOIN users ON users.id = posts.id_user
                                GROUP BY posts.id
                                HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)
                                AND posts.id_user IN (SELECT followers.id_user FROM followers WHERE followers.follower = ?)
                                ORDER BY posts.date DESC LIMIT ?,?");

             $stmt->bind_param("sssssss", $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_follow'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
             }
             break;
         case 'new':
             $stmt = $db->prepare("SELECT
                                posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, users.first_name, posts.description, posts.date,
                                posts.points, posts.activity, posts.duration, posts.length, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                  THEN '1'
                                  ELSE '0'
                                  END AS 'liked',
                                CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                  THEN '1'
                                  ELSE '0'
                                  END AS 'bookmark',
                                (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                FROM posts
                                LEFT JOIN comments ON comments.id_post = posts.id
                                INNER JOIN users ON users.id = posts.id_user
                                GROUP BY posts.id
                                HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)
                                ORDER BY posts.date DESC LIMIT ?,?");

             $stmt->bind_param("ssssss", $_SESSION['id'], $_SESSION['id'], $_SESSION['id'],$_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['empty_all'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
             }
             break;
         case 'trends':
             if($limit+1>20)return;
             $stmt = $db->prepare("SELECT
                                          posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, users.first_name, posts.description, posts.date,
                                          posts.points, posts.activity, posts.duration, posts.length, posts.collaboration, COUNT(comments.id) as 'countcomments',
                                          CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                          THEN '1'
                                          ELSE '0'
                                          END AS 'liked',
                                          CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                          THEN '1'
                                          ELSE '0'
                                          END AS 'bookmark',
                                          (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                                          FROM posts
                                          LEFT JOIN comments ON comments.id_post = posts.id
                                          INNER JOIN users ON users.id = posts.id_user
                                          GROUP BY posts.id
                                          HAVING posts.id IN (
                                            SELECT id_post
                                            FROM likes
                                            WHERE DATEDIFF(CURRENT_TIMESTAMP, date)<=14
                                            GROUP BY id_post
                                            )
                                          ORDER BY countlikes DESC,posts.date DESC LIMIT ?,?");

             $stmt->bind_param("ssss", $_SESSION['id'], $_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_follow'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
             }
             break;
         case 'recommended':
         $stmt = $db->prepare("SELECT
                                        posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date, posts.place,
                                        posts.points, posts.activity, posts.duration, posts.length, posts.collaboration,
                                        CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'liked',
                                        CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'bookmark',
                                        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes',
                                        (SELECT COUNT(*) FROM comments WHERE comments.id_post = posts.id) as 'countcomments'
                                        FROM posts
                                        LEFT JOIN comments ON comments.id_post = posts.id
                                        INNER JOIN users ON users.id = posts.id_user
                                        WHERE posts.id IN (SELECT MAX(id) FROM posts GROUP BY id_user)
                                        AND posts.id_user IN (
                                        SELECT
                                        DISTINCT followers.id_user
                                        FROM followers
                                        WHERE follower IN (SELECT followers.id_user FROM followers WHERE follower = ?)
                                        AND followers.id_user NOT IN (SELECT id_user FROM followers WHERE follower = ?)
                                        AND followers.id_user != ?
                                        )
                                        
                                        UNION DISTINCT
                                        
                                        SELECT DISTINCT
                                        posts.id, posts.id_user as 'userid', users.profile_picture, users.nick_name, posts.description, posts.date, posts.place,
                                        posts.points, posts.activity, posts.duration, posts.length, posts.collaboration,
                                        CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'liked',
                                        CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                                        THEN '1'
                                        ELSE '0'
                                        END AS 'bookmark',
                                        (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes',
                                        (SELECT COUNT(*) FROM comments WHERE comments.id_post = posts.id) as 'countcomments'
                                        FROM posts
                                        LEFT JOIN comments ON comments.id_post = posts.id
                                        INNER JOIN users ON users.id = posts.id_user
                                        WHERE place IN (SELECT DISTINCT place FROM posts WHERE id_user = ?)
                                        AND posts.id IN (SELECT MAX(id) FROM posts WHERE  place IN (SELECT DISTINCT place FROM posts WHERE id_user = ?) GROUP BY posts.id_user)
                                        
                                        
                                        HAVING posts.id_user!=?
                                        AND posts.id_user NOT IN (SELECT followers.id_user FROM followers WHERE followers.follower=?)
                                        AND posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                                        AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)
                                        ORDER BY date DESC
                                        LIMIT ?,?;");

             $stmt->bind_param("sssssssssssssss", $_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'], $_SESSION['id'],$_SESSION['id'],$_SESSION['id'],$_SESSION['id'], $_SESSION['id'],$_SESSION['id'], $limit,$_POST['end_limit']);
             $stmt->execute();
             $result = $stmt->get_result();
             $num_rows = mysqli_num_rows($result);
             if ($num_rows == 0) {
                 if ($limit > 0) {
                     return;
                 }
                 echo '<div id="content-empty">
                  ' . $lang['user_follow'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
             }
             break;
         case 'searchp':

             if(!isset($_POST['search'])){

                 if(!isset($_POST['place']) || empty($_POST['place'])){
                     echo '<div id="content-empty">
                  '. $lang['no_draw'] .' <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
                     return;
                 }

                 $place = $_POST['place'];
                 $place1 = '%'.$_POST['place'].'%';
                 $place2 = '%'.$_POST['place'];
                 $place3 = $_POST['place'].'%';

                 $query="   SELECT
                            posts.id, posts.id_user as 'userid', users.profile_picture, posts.place, users.nick_name, users.first_name, posts.description, posts.date,
                            posts.points, posts.activity, posts.duration, posts.length, posts.collaboration, COUNT(comments.id) as 'countcomments',
                            CASE WHEN EXISTS (SELECT * FROM likes WHERE likes.id_user = ? AND likes.id_post = posts.id)
                            THEN '1'
                            ELSE '0'
                            END AS 'liked',
                            CASE WHEN EXISTS (SELECT * FROM bookmarks WHERE bookmarks.id_user = ? AND bookmarks.id_post = posts.id)
                            THEN '1'
                            ELSE '0'
                            END AS 'bookmark',
                            (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id) as 'countlikes'
                            FROM posts
                            LEFT JOIN comments ON comments.id_post = posts.id
                            INNER JOIN users ON users.id = posts.id_user
                            WHERE LOWER(posts.place) LIKE LOWER(?)
                            GROUP BY posts.id
                            HAVING posts.id NOT IN (SELECT blocked_posts.id_post FROM blocked_posts WHERE blocked_posts.id_user = ?)
                            AND posts.id_user NOT IN (SELECT blocked_users.blocked FROM blocked_users WHERE blocked_users.user_id = ?)
                            ORDER BY";
                 $query2=" posts.date DESC";

                 switch ($_POST['filter']){
                     case 0:
                         break;
                     case 1:
                         $query2= " countlikes DESC";
                         break;
                     case 2:
                         $query2= " posts.date DESC";
                         break;
                     case 3:
                         $query2= " posts.date";
                         break;
                 }

                 $stmt = $db->prepare($query.$query2.' LIMIT ?,?');

                 $stmt->bind_param("sssssss", $_SESSION['id'], $_SESSION['id'], $place1 ,$_SESSION['id'],$_SESSION['id'], $limit,$_POST['end_limit']);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 $num_rows = mysqli_num_rows($result);
                 if ($num_rows == 0) {
                     if ($limit > 0) {
                         return;
                     }
                     echo '<div id="content-empty">
                  ' . $lang['no_draw'] . '  <br>  
                 <img src="https://png.icons8.com/ios-glyphs/90/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';  echo'/sad.png"> 
                 </div>';
                 }
             }else{
                 echo '
            <div id="filter-search">
            
                <div id="search-text">'.$lang['seach_by_place'].'</div>
            
                <div id="search-filter">
                    <select id="select-filter">
                        <option style="display:none" value="0" disabled selected>'.$lang['order_by'].'</option>
                        <option value="1">'.$lang['likes_counts'].'</option>
                        <option value="2">'.$lang['latest'].'</option>
                        <option value="3">'.$lang['oldest'].'</option>
                    </select>
                </div> 
             
                <div id="search-by-place">
                    <input type="text" placeholder="'.$lang['search'].'" id="searchplace" name="searchbyplace">
                </div>
            
                <div id="search-button">
                    <button id="test123" type="submit">'.$lang['search'].'</button>
                </div>
            
            </div>
            
            <div id="body-a" style="width: 100%; left:0;">
            </div>
            
              ';
                 $result=null;
             }

             break;
     }

     if($result==null)return;

     while ($row = $result->fetch_assoc()) {

         if($row['collaboration']!=0){
             $stmt2 = $db->prepare("SELECT DISTINCT users.nick_name FROM users_in_collab INNER JOIN users ON users_in_collab.id_user = users.id WHERE users_in_collab.id_collaboration = ?");
             $stmt2->bind_param("i", $row['collaboration']);
             $stmt2->execute();
             $result2 = $stmt2->get_result();
         }else{
             $result2=null;
         }
         include("../html/main-post.php");
     }
