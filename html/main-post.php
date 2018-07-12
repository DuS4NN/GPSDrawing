
<div id="post">
    <table width="100%" border="0">
        <tr>
            <td width="55px">
                <div id="profile-picture">
                    <img id="picture" src="<?php echo $web ?>/<?php echo $row['profile_picture'] ?>" />
                </div>
            </td>
            <td valign="bottom">
                <div id="profile-nick">
                    <a href="../users/<?php echo $row['nick_name']; ?>"><h7><b><?php echo $row['nick_name']; ?></b></h7></a><br>
                </div>
                <div id="time">
                    <?php

                    $date = $row['date'];
                    $newd = date_create_from_format('Y-m-d H:i',$date);
                    $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                    $time = time();


                    //echo date("Y-m-d H:i", $milisec);
                    if($time-$milisec<60){
                        echo intval(($time-$milisec)) . ' sec.';
                    }else if($time-$milisec<3600){
                        echo intval(($time-$milisec)/60) . ' min.';
                    }else if($time-$milisec<86400){
                        echo intval(($time-$milisec)/3600) .' hod.';
                    }else if($time-$milisec<2592000){
                        echo date("d. M H:i",$milisec);
                    }else{
                        $date1 = date("Y",$time);
                        $date2 = date("Y",$milisec);
                        if($date1==$date2){
                            echo date("d. M",$milisec);
                        }else{
                            echo date("d. M. Y",$milisec);
                        }
                    }

                    ?>
                </div>
            </td>
            <td rowspan="2" valign="top">
                <div  id="comment-like">
                    <table align="right">
                        <tr>
                            <td>
                                <div id="like-image">
                                    <img src="<?php echo $web ?>/img/<?php if($row['liked']==0) echo 'unlike'; else echo 'like'  ?>.png" id="like<?php echo $row['id'] ?>" class="like" onclick="like(<?php echo $row['id'] ?>)">
                                </div>
                            </td>
                            <td>
                                <div id="like-number">
                                    <b id="countlikes<?php echo $row['id'] ?>">&nbsp <?php echo $row['countlikes'] ?></b><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="baseline">
                                <div id="comment-image">
                                    <img src="<?php echo $web ?>/img/comment.png" class="commicon">
                                </div>
                            </td>
                            <td valign="middle">
                                <div id="comment-number">
                                    <b>&nbsp <?php echo $row['countcomments'] ?></b>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <div id="post-description">
                    <?php echo utf8_encode($row['description']); ?>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div id="map<?php echo $row['id'] ?>" class="map">
                    <img style="width: 1px; height: 1px" onload="initMap(<?php echo $row['id'] ?> , '<?php echo $row['points'] ?>')" src="<?php echo $web ?>/img/load.png"/>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div id="post-footer">
                    <div id="footer-activity">
                        <img src="<?php echo $web ?>/img/activity.png" title="Calendar" width="20" height="20"><?php echo $lang['activity'] ?>:<br>
                        <?php switch ($row['activity']){
                            case 0:
                                echo $lang['walking'];
                                break;
                            case 1:
                                echo $lang['running'];
                                break;
                            case 2:
                                echo $lang['cycling'];
                                break;
                            case 3:
                                echo $lang['driving'];
                        }  ?>
                    </div>
                    <div id="footer-distance">
                        <img src="https://png.icons8.com/map-pinpoint/ultraviolet/80" title="Map Pinpoint" width="20" height="20"><?php echo $lang['distance'] ?>:<br>
                        <?php echo $row['distance']; ?>
                    </div>
                    <div id="footer-time">
                        <img src="https://png.icons8.com/time/ultraviolet/80" title="Time" width="20" height="20"><?php echo $lang['time'] ?><br>
                        <?php echo $row['time']; ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>






<div id="image">
    <table width="100%" style="background: white">
        <tr>
            <td width="60%">
                <div id="head_image">
                    <img id="profilepicture" src="<?php echo $web ?>/<?php echo $row['profile_picture'] ?>" class="img-circle" height="40px" width="40px"/>
                    <a href="../users/<?php echo $row['nick_name']; ?>"><h7><b><?php echo $row['nick_name']; ?></b></h7></a>
                    <br>
                    <?php echo $row['description']; ?>
                </div>
            </td>
            <td>
                <div id="head_likes">

                    <img src="<?php echo $web ?>/img/<?php if($row['liked']==0) echo 'unlike'; else echo 'like'  ?>.png" id="like<?php echo $row['id'] ?>" class="like" onclick="like(<?php echo $row['id'] ?>)">
                    <b id="countlikes<?php echo $row['id'] ?>" style="color:black">&nbsp <?php echo $row['countlikes'] ?></b><br>

                    <img src="<?php echo $web ?>/img/comment.png" class="commicon" width="24px" height="24px">
                    <b style="color:black">&nbsp <?php echo $row['countcomments'] ?></b>

                </div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div style="width: 100%;height: 300px" id="map<?php echo $row['id'] ?>" class="map">
                    <img style="width: 0px; height: 0px" onload="initMap(<?php echo $row['id'] ?> , '<?php echo $row['points'] ?>')" src="<?php echo $web ?>/img/load.png"/>
                </div>
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <div id="footer_icons">
                    <img src="https://png.icons8.com/map-pinpoint/ultraviolet/80" title="Map Pinpoint" width="40" height="40"> 50 km&nbsp
                    <img src="https://png.icons8.com/time/ultraviolet/80" title="Time" width="40" height="40"> 1,40 h&nbsp
                    <img src="https://png.icons8.com/calendar/ultraviolet/80" title="Calendar" width="40" height="40">
                    <div class="comments" style="display:none;" id=" <?php echo $row['id']; ?>">
                        <hr width="100%">
                        com
                        <hr width="100%">
                        <input name="addcomment" type="text" placeholder="Napísať komentár..">
                        <img src="http://localhost/GPS%20Drawing/img/comment.png" class="commicon" width="24px" height="24px">
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
