<?php
session_start();
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    $_SESSION['alerts'] = "error:9";
    header("location: ../GPSDrawing/welcome");
}
require '../config/db.php';
require '../config/lang.php';
ini_set("default_charset", "UTF-8");
header('Content-type: text/html; charset=UTF-8');

?>

<html>
<head>
    <title><?php echo $lang['title_index'] ?></title>
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/projects.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="<?php echo $web ?>/js/load-map.js"></script>
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>



</head>
<body>

<?php require '../html/header.html'; ?>

<div id="body" style="width: 100%; left:0;">



    <div id="projects-container">
        <div id="projects-list">
            <div id="projects-list-item" class="md-trigger"  data-modal="modal-create-new-projects">
                <div id="projects-list-item-text">Create new project</div>
                <div id="projects-list-item-more"></div>
            </div>

            <?php
            $stmt = $db->prepare("SELECT * FROM projects WHERE id_user = ?");
            $stmt->bind_param("s",$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()){
                echo '<div id="projects-list-item" class="project-'.$row['id'].'">
                              <div id="projects-list-item-text">'.$row['name'].'</div>
                              <div id="projects-list-item-more"><span id="'.$row['id'].'" class="fas fa-ellipsis-v md-trigger" data-modal="modal-delete-project" ></span></div>
                          </div>';
            }
            ?>
        </div>
        <div id="projects-content">

        </div>
    </div>



</div>

<script>
    $(document).on('click','#projects-list-item',function () {
        if($(this).hasClass('md-trigger'))return;
       let id_project = $(this).attr('class').split('-')[1];
       $.ajax({
            type: 'POST',
            url:  localStorage.getItem("web")+"/php/projects.php",
            data: {action: 5, id_project: id_project},
            success: function(response) {
               $('#projects-content').html(response);
            }
       });
    });

</script>


<div id="alerts-2">
    <?php require '../php/alerts.php'; ?>
</div>


<?php require '../html/modals.html'; ?>


<div id="overlay" class="md-overlay"></div>


<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/projects.js"></script>
<script src="<?php echo $web ?>/js/modalEffects.js"></script>
<script src="<?php echo $web ?>/js/comments.js"></script>
<script src="<?php echo $web ?>/js/post-more.js"></script>
<script src="<?php echo $web ?>/js/like.js"></script>
<script src="<?php echo $web; ?>/js/load-theme.js"></script>


</body>
</html>
