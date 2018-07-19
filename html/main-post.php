<div id="post" class="post<?php echo $row['id']; ?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="60px">
                <div id="profile-picture">
                    <img id="picture" src="<?php echo $web ?>/<?php echo $row['profile_picture'] ?>" />
                </div>
            </td>
            <td valign="bottom">
                <div id="profile-nick">
                    <a href="../<?php echo $row['nick_name']; ?>"><h7><b><?php echo $row['nick_name']; ?></b></h7></a><br>
                </div>
                <div id="time">
                    <?php

                    $date = $row['date'];
                    $newd = date_create_from_format('Y-m-d H:i',$date);
                    $milisec = ($newd->getTimestamp()+$_SESSION['time']);
                    $time = time();


                    //echo date("Y-m-d H:i", $milisec);
                    if($time-$milisec<60){
                        echo intval(($time-$milisec)).' '.$lang['sec'].'.';
                    }else if($time-$milisec<3600){
                        echo intval(($time-$milisec)/60) . ' min.';
                    }else if($time-$milisec<86400){
                        echo intval(($time-$milisec)/3600).' '.$lang['hod'].'.';
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
                    <table align="right" style="margin-right: 10px; margin-top: 5px">
                        <tr>
                            <td>
                                <div id="like-image">
                                    <img src="<?php echo $web ?>/img/<?php if($row['liked']==0) echo 'unlike'; else echo 'like'  ?>.png" id="like<?php echo $row['id'] ?>" class="like" onclick="like(<?php echo $row['id'] ?>)">
                                </div>
                            </td>
                            <td>
                                <div id="like-number">
                                    <b id="countlikes<?php echo $row['id'] ?>"> <?php echo $row['countlikes'] ?></b><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="baseline">
                                <div id="comment-image">
                                    <img src="<?php echo $web ?>/img/comment.png" class="commicon" onclick="showCom(<?php echo $row['id']; ?>)">
                                </div>
                            </td>
                            <td valign="middle">
                                <div id="comment-number">
                                    <b id="comment-number<?php echo $row['id'] ?>"><?php echo $row['countcomments'] ?></b>
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
                <?php
                    if(isset($result2)){
                        echo "<div id='post-coop'>";

                        echo $lang['collaboration'];
                        $row_cnt = sizeof($result2);
                        $loop_cnt = 0;
                        while($row2 = $result2->fetch_assoc()){
                            echo
                                " <a href='".$web."/".$row2['nick_name']."'>".$row2['nick_name']."</a>";
                            if($loop_cnt<$row_cnt){
                                echo ",";
                            }
                                $loop_cnt++;
                        }
                        echo "</div>";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
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
                        <span id="post-footer-desc"><?php echo $lang['distance'] ?>:<br></span> <?php echo $row['distance']; ?> km
                    </div>
                    <div id="footer-time">
                        <img src="<?php echo $web ?>/img/stopwatch.png" title="<?php echo $lang['time']; ?>">
                        <span id="post-footer-desc"><?php echo $lang['time'] ?>:<br></span> <?php echo $row['time']; ?> min
                    </div>
                    <div id="post-footer-side">
                    </div>
                </div>
            </td>
        </tr>
        <tr>
        <td colspan="3">
            <div id="comments-body<?php echo $row['id']; ?>" style="display: none ">
                <div id="comment-form">
                    <div id="profile-picture-comment">
                        <img  src="<?php echo $web ?>/<?php echo $row['profile_picture'] ?>" />
                    </div>
                    <div id="comment-input">
                        <input edit="0" minlength="1" class="add-comment" id="add-comment-<?php echo $row['id']; ?>" type="text" placeholder="<?php echo $lang['write_comment']; ?>">
                        <div style="visibility: hidden" onclick="cancel_edit(<?php echo $row['id']; ?>)" class="cancel-edit" id="cancel-edit<?php echo $row['id']; ?>"><i class="fas fa-times"></i>&nbsp;<?php echo $lang['cancel']; ?></div>
                    </div>
                    <br>
                </div>

                <div class="load-more" load="5" id="loadmore-<?php echo $row['id']; ?>">
                    Load more
                </div>

                <div class="comment-section" style="width: 95%; margin: auto;" id="comment-section<?php echo $row['id']; ?>"></div>
            </div>
        </tr>
        <tr>
            <td colspan="3">
                <div class="post-more-<?php echo $row['id']; ?>"  id="post-more">
                    <img src="<?php echo $web; ?>/img/more.png" />
                </div>
            </td>
        </tr>
    </table>
</div>


<script>

    $(function() {
        $.contextMenu({
            trigger: 'left',
            selector: '.post-more-<?php echo $row['id']; ?>',
            callback: function(key, options) {
                if(key==""){

                }else if(key==""){

                }
            },
            items: {
                <?php
                    if($_SESSION['id']==$row['userid']){
                            if($row['bookmark']==1){
                            echo '
                                "remove_from_bookmarks": {name: "'.$lang['remove_from_bookmarks'].'", icon: "fas fa-bookmark"},
                                "dis1": {name: "'.$lang['rfb_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            ';
                            }else{
                            echo '
                                "add_to_bookmarks": {name: "'.$lang['add_to_bookmarks'].'", icon: "far fa-bookmark"},
                                "dis1": {name: "'.$lang['atb_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            ';
                            }
                        echo '                     
                            "edit_description": {name: "'.$lang['edit_description'].'", icon: "far fa-edit"},
                            "dis2": {name: "'.$lang['edit_post_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            "delete_post": {name: "'.$lang['delete_post'].'", icon: "far fa-trash-alt"},
                            "dis3": {name: "'.$lang['delete_post_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}}
                        ';
                    }else{
                        if($row['bookmark']==1){
                            echo '
                                "remove_from_bookmarks": {name: "'.$lang['remove_from_bookmarks'].'", icon: "fas fa-bookmark"},
                                "dis1": {name: "'.$lang['rfb_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            ';
                        }else{
                            echo '
                                "add_to_bookmarks": {name: "'.$lang['add_to_bookmarks'].'", icon: "far fa-bookmark"},
                                "dis1": {name: "'.$lang['atb_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            ';
                        }
                        echo '                       
                            "hide_post": {name: "'.$lang['hide_post'].'", icon: "fas fa-ban"},
                            "dis2": {name: "'.$lang['hide_post_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},
                            "report_post": {name: "'.$lang['report_post'].'", icon: "far fa-flag"},
                            "dis3": {name: "'.$lang['report_post_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}}
                            
                        ';
                    }
                ?>
            }
        });
    });

</script>

