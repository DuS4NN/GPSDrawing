<div id="map<?php echo $row['id_project'] ?>" class="map">
    <img style="width: 1px; height: 1px" onload="initMap(<?php echo $row['id_project']; ?> , '<?php echo substr($points,1,strlen($points)); ?>','<?php echo $_SESSION['color']; ?>', '<?php echo $_SESSION['color_of_collab']; ?>','<?php echo $_SESSION['color_icon'];?>','<?php echo $_SESSION['show_icons']; ?>',<?php echo $_SESSION['map_theme'];?>,'<?php echo '1'; ?>')" src="<?php echo $web; ?>/img/load.png"/>
</div>

<div id="post-footer-side">
</div>
<div id="footer-activity">
    <img src="<?php echo $web ?>/img/activity.png" title="<?php echo $lang['activity']; ?>">
    <span id="post-footer-desc"><?php echo $lang['activity'] ?>:</span><br>
    <?php echo $lang['walking']; ?>
</div>
<div id="footer-distance">
    <img src="<?php echo $web ?>/img/distance.png" title="<?php echo $lang['distance']; ?>">
    <span id="post-footer-desc"><?php echo $lang['distance'] ?>:<br></span><span id="post-footer-distance-<?php echo $row['id_project']; ?>">0</span>
</div>
<div id="footer-time">
    <img src="<?php echo $web ?>/img/stopwatch.png" title="<?php echo $lang['time']; ?>">
    <span id="post-footer-desc"><?php echo $lang['time'] ?>:<br></span><span id="post-footer-duration-<?php echo $row['id_project']; ?>">0</span>
</div>
<div id="post-footer-side">
</div>
</div>
