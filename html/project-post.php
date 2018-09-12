<div id="map<?php echo $row['id_project'] ?>" class="map">
    <img style="width: 1px; height: 1px" onload="initMap(<?php echo $row['id_project']; ?> , '<?php echo substr($points,1,strlen($points)); ?>','<?php echo $_SESSION['color']; ?>', '<?php echo $_SESSION['color_of_collab']; ?>','<?php echo $_SESSION['color_icon'];?>','<?php echo $_SESSION['show_icons']; ?>',<?php echo $_SESSION['map_theme'];?>,'<?php echo '1'; ?>')" src="<?php echo $web; ?>/img/load.png"/>
</div>


