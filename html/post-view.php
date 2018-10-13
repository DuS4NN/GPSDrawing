<div id="post-<?php echo $row['id'];?>" class="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="map-right" width="60%">
                <!-- MAPA -->
                <div id="map<?php echo $row['id'] ?>" class="map">
                    <img style="width: 1px; height: 1px" onload="initMap(<?php echo $row['id']; ?> , '<?php echo $row['points']; ?>','<?php echo $_SESSION['color']; ?>', '<?php echo $_SESSION['color_of_collab']; ?>','<?php echo $_SESSION['color_icon'];?>','<?php echo $_SESSION['show_icons']; ?>',<?php echo $_SESSION['map_theme'];?>,'<?php echo $row['activity']; ?>')" src="<?php echo $web; ?>/img/load.png"/>
                </div>
            </td>
            <td class="info-left" width="40%" rowspan="4" valign="top">
                <table class="table-info" style="height: 100%" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <div id="post-user-info">
                                <div id="post-user-picture" style="background-image: url(<?php echo $web ?>/<?php echo $row['profile_picture'] ?>)">

                                </div>

                                <div id="post-user-nick-date">
                                    <div id="post-user-nick">
                                        <a href="<?php echo $web?>/user/<?php echo $row['nick_name']; ?>"><h7><b><?php echo $row['nick_name']; ?></b></h7></a><br>
                                    </div>
                                    <div id="post-user-date">
                                        <?php

                                        $date = $row['date'];
                                        $newd = date_create_from_format('Y-m-d H:i',$date);
                                        $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                                        $time = time();

                                        if($_SESSION['lang']=='sk'){
                                            setlocale(LC_TIME, 'sk-SK');
                                        }else{
                                            setlocale(LC_TIME, 'en-EN');
                                        }

                                        //echo date("Y-m-d H:i", $milisec);
                                        if($time-$milisec<60){
                                            echo intval(($time-$milisec)).' '.$lang['sec'].'.';
                                        }else if($time-$milisec<3600){
                                            echo intval(($time-$milisec)/60) . ' min.';
                                        }else if($time-$milisec<86400){
                                            echo intval(($time-$milisec)/3600).' '.$lang['hod'].'.';
                                        }else if($time-$milisec<2592000){
                                            echo utf8_encode(ucwords(strftime("%#d. %b %H:%M",$milisec)));

                                        }else{
                                            $date1 = date("Y",$time);
                                            $date2 = date("Y",$milisec);
                                            if($date1==$date2){
                                                echo utf8_encode(ucwords(strftime("%#d. %b",$milisec)));
                                            }else{
                                                echo utf8_encode(ucwords(strftime("%#d. %b %Y",$milisec)));
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="post-description" id="post-description-<?php echo $row['id'];?>">
                                <?php echo $row['description']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="post-like-comment">
                            <div id="post-like">
                                <div id="like-image">
                                    <img src="<?php echo $web ?>/img/<?php if($row['liked']==0){echo 'unlike';}else{echo 'like';}if($_SESSION['night_mode']==1) echo '-w'; ?>.png" id="like<?php echo $row['id'] ?>" class="like" onclick="like(<?php echo $row['id'] ?>)">
                                </div>
                                <div id="like-number">
                                    <b id="countlikes<?php echo $row['id'] ?>"> <?php echo $row['countlikes'] ?></b><br>
                                </div>
                            </div>

                            <div id="post-comment">
                                <div id="comment-image">
                                    <img src="https://png.icons8.com/ios/100/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; ?>/speech-bubble-with-dots.png" class="commicon">
                                </div>
                                <div id="comment-number">
                                    <b id="comment-number<?php echo $row['id'] ?>"><?php echo $row['countcomments'] ?></b>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="comments">
                            <!-- KOMENTARE -->
                            <div class="comments-body" id="comments-body<?php echo $row['id']; ?>">
                                <br>
                                <div id="comment-form">
                                    <div id="profile-picture-comment" style="background-image: url(<?php echo $web ?>/<?php echo $row['profile_picture'] ?>)">

                                    </div>
                                    <div id="comment-input">
                                        <input edit="0"  maxlength="300" class="add-comment" id="add-comment-<?php echo $row['id']; ?>" type="text" placeholder="<?php echo $lang['write_comment']; ?>">
                                        <div style="visibility: hidden" onclick="cancel_edit(<?php echo $row['id']; ?>)" class="cancel-edit" id="cancel-edit<?php echo $row['id']; ?>"><i class="fas fa-times"></i>&nbsp;<?php echo $lang['cancel']; ?></div>
                                    </div>

                                </div>
                                <div class="comment-section" id="comment-section<?php echo $row['id']; ?>">
                                    <script>
                                        $.ajax({
                                            type:"POST",
                                            url: localStorage.getItem("web")+"/php/load_comments.php",
                                            data: {id: <?php echo $row['id']; ?>,num: 0},
                                            success: function(response){
                                                $("#comment-section"+<?php echo $row['id']; ?>).append(response);
                                            }
                                        });

                                        setTimeout(function () {
                                            $.ajax({
                                                type:"POST",
                                                url: localStorage.getItem("web")+"/php/load_comments.php",
                                                data: {id: <?php echo $row['id']; ?>,num: 5},
                                                success: function(response){
                                                    $("#comment-section"+<?php echo $row['id']; ?>).append(response);
                                                }
                                            });
                                        },250);

                                        setTimeout(function () {
                                            $.ajax({
                                                type:"POST",
                                                url: localStorage.getItem("web")+"/php/load_comments.php",
                                                data: {id: <?php echo $row['id']; ?>,num: 5},
                                                success: function(response){
                                                    $("#comment-section"+<?php echo $row['id']; ?>).append(response);
                                                }
                                            });
                                        },250);

                                    </script>
                                </div>
                                <div style="width: 100%;float: left">
                                    <div class="load-more" load="15" id="loadmore-<?php echo $row['id']; ?>">
                                        <?php echo $lang['load_more']?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td class="border-right"">
                <?php
                if(isset($result2)){
                    echo "<div id='post-coop'>";

                    echo $lang['collaboration'];
                    $row_cnt = sizeof($result2);
                    $loop_cnt = 0;
                    while($row2 = $result2->fetch_assoc()){
                        if($row2['nick_name']==$row['nick_name']){
                            continue;
                        }
                        echo
                            " <a href='".$web."/user/".$row2['nick_name']."'>".$row2['nick_name']."</a>";
                        if($loop_cnt<$row_cnt){
                            echo ",";
                        }
                        $loop_cnt++;
                    }
                    echo "</div>";
                }else{
                    echo '<div id="post-start">
                    <img src="https://png.icons8.com/metro/52/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; echo'/marker.png">
                    <span id="post-start-location"></span>
                </div>
                <div  id=post-end>
                    <img src="https://png.icons8.com/ios-glyphs/100/'; if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; echo'/finish-flag.png">
                    <span id="post-end-location"></span>
                </div>';
                }
                ?>


            </td>
        </tr>

        <tr>
            <td class="border-right"">
                <!-- GRAF -->
                <div id="elevation_chart"></div>
            </td>

        </tr>

        <tr>
            <td class="border-right"">
              <!-- INFO -->
                <div id="post-footer">
                    <div id="post-footer-side">
                    </div>
                    <div id="footer-activity">
                        <img src="<?php echo $web ?>/img/activity.png" title="<?php echo $lang['activity']; ?>">
                        <span id="post-footer-desc"><?php echo $lang['activity'] ?>:</span><br>
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
                        <img src="<?php echo $web ?>/img/distance.png" title="<?php echo $lang['distance']; ?>">
                        <span id="post-footer-desc"><?php echo $lang['distance'] ?>:<br></span><span id="post-footer-distance-<?php echo $row['id']; ?>">
                             <?php
                             echo round($row['length']/1000,2) ." km";
                             ?>
                        </span>
                    </div>
                    <div id="footer-time">
                        <img src="<?php echo $web ?>/img/stopwatch.png" title="<?php echo $lang['time']; ?>">
                        <span id="post-footer-desc"><?php echo $lang['time'] ?>:<br></span><span id="post-footer-duration-<?php echo $row['id']; ?>">
                            <?php
                            $duration = round($row['duration']/1000);
                            if ($duration <= 60) {
                                echo $duration." s";
                            } else if ($duration > 60 && $duration < 3600) {
                                echo round($duration/60) ." min";
                            } else {
                                echo round($duration/60/60) ." h ". round($duration/60%60) ." min";
                            }
                            ?>
                        </span>
                    </div>
                    <div id="post-footer-side">
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <td class="border-right">
            </td>
            <td>
                <div class="post-more-<?php echo $row['id']; ?>"  id="post-more">
                    <img class="md-trigger" id="<?php echo $row['id']?>" data-modal=
                    "<?php
                    if($row['userid']==$_SESSION['id']){
                        if($row['bookmark']==0) echo 'modal-3';
                        else echo 'modal-4';
                    }else{
                        if($row['bookmark']==0) echo 'modal-1';
                        else echo 'modal-2';
                    }

                    ?>"
                         src="https://png.icons8.com/android/96/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000'; ?>/more.png" />
                </div>
            </td>
        </tr>
    </table>

</div>



<script>
    let maxh = $('.post').height()+120;
    let desc = $('.post-description').height();
    let other = $('#post-user-info').height()+7 + $('.post-like-comment').height() + 100 + $('.load-more').height() ;
    $('.comment-section').height(maxh - desc - other);
</script>