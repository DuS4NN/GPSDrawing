<div id="comment<?php echo $row['comid']; ?>">
    <div class="comment" style="width: 100%">
        <div id="comment-comment">
            <a href="<?php echo $web; ?>/user/<?php echo $row['nick_name']; ?>"><?php echo $row['nick_name']; ?></a><span id="comment-text-<?php echo $row['comid']?>"> <?php echo $row['comment']; ?></span>
        </div>
        <div class="comment-more" id="comment-more-<?php echo $row['comid']; ?>">
            <img class="md-trigger" data-modal="<?php if($_SESSION['id']==$row['id_user'])echo 'modal-5';  else echo 'modal-6';?>"  id="comment-more-menu-<?php echo $row['comid']; ?>:<?php echo $row['id_post'] ; ?>" src="<?php echo $web; ?>/img/more.png" />
        </div>
    </div>

    <div id="comment-time">
        <?php

        $date = $row['time'];
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

