<div id="comment<?php echo $row['comid']; ?>">
    <div class="comment" style="width: 100%">
        <div id="comment-comment">
            <a href="<?php echo $web; ?>/<?php echo $row['nick_name']; ?>"><?php echo $row['nick_name']; ?></a><span id="comment-text-<?php echo $row['comid']?>"> <?php echo $row['comment']; ?></span>
        </div>
        <div class="comment-more" id="comment-more-<?php echo $row['comid']; ?>">
            <img class="comment-more-menu<?php echo $row['comid']; ?>" id="comment-more-menu-<?php echo $row['comid']; ?>:<?php echo $row['id_post'] ; ?>" src="<?php echo $web; ?>/img/more.png" />
        </div>
    </div>

    <div id="comment-time">
        <?php
        $date = $row['time'];
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
</div>

<script>
    $.contextMenu({
        trigger: 'left',
        selector: '.comment-more-menu<?php echo $row['comid']; ?>',
        callback: function(key, options) {
            var id = options['$trigger'][0]['id'];
            if(key=="delete"){
                deleteComment(id);
            }else if(key=="edit"){
                editComment(id);
            }else if(key=="hide"){
                hideComment(id);

            }
        },
        items: {
            <?php
                if($row['commented']==1){
                    echo '"edit": {name: "'.$lang['edit_comment'].'", icon: "far fa-edit"},   
                          "dis": {name: "'.$lang['edit_comment_desc'].'", icon: "", disabled: function(key,opt){return !this.data("disDisabled");}},  
                          "delete": {name: "'.$lang['delete_comment'].'", icon: "far fa-trash-alt"},   
                          "dis2": {name: "'.$lang['delete_comment_desc'].'", icon: "", disabled: function(key,opt){return !this.data("dis2Disabled");}}
                          ';
                }else{
                    echo '"hide": {name: "'.$lang['hide_comment'].'", icon: "fas fa-ban"},
                          "dis3": {name: "'.$lang['hide_comment_desc'].'", icon: "", disabled: function(key,opt){return !this.data("dis3Disabled");}}';
                }
            ?>
        }
    });
</script>


