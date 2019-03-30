<?php
session_start();
require '../config/db.php';
require '../config/lang.php';

if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    $_SESSION['alerts'] = "error:9";
    header("location: ".$web."/welcome");
}

ini_set("default_charset", "UTF-8");
header('Content-type: text/html; charset=UTF-8');

?>

<html>
<head>
    <title><?php echo $lang['title_index'] ?></title>
    <link rel="stylesheet" href="<?php echo $web ?>/css/alerts-main.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/modal.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/main-post.css">
    <link rel="stylesheet" href="<?php echo $web ?>/css/projects.css">
    <?php if($_SESSION['night_mode']==1)echo '<link rel="stylesheet" href="'.$web.'/css/dark_mode.css">';?>
    <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="<?php echo $web ?>/js/load-map.js"></script>
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&language=<?php echo $_SESSION['lang']?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>



</head>
<body>

<?php require '../html/header.html'; ?>

<div id="body" style="width: 100%; left:0">



    <div id="projects-container">
        <div id="projects-list">
            <div id="projects-list-item" class="md-trigger"  data-modal="modal-create-new-projects">
                <div id="projects-list-item-text" class="add-project">Create new project</div>
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
            <div id="main-text"><?php echo $lang['create_with_friends']; ?></div>
            <div id="main-img"><img src="https://png.icons8.com/dotty/96/<?php if($_SESSION['night_mode']==1) echo 'FFFFFF'; else echo '000000';?>/task.png"></div>
            <div id="main-desc"><?php echo $lang['create_project_desc']; ?></div>
            <div id="main-desc-s"><?php echo $lang['create_project_desc_small']; ?></div>
        </div>
    </div>
</div>

<script>


    $(document).on('click',"#projects-content-delete", function () {
        let id_project = $('.map').attr('id').replace('map','');
        let id_post = $(this).parent().attr('class').split('-')[1];
        $.ajax({
            type: 'POST',
            url:  localStorage.getItem("web")+"/php/projects.php",
            data: {action: 6, id_project: id_project, id_post: id_post},
            success: function(response) {
                let alertSection = document.getElementById("alerts-2");
                let text = alertSection.innerHTML;
                alertSection.innerHTML = text + response;
                closeAlert('remove');
            }
        });

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                url:  localStorage.getItem("web")+"/php/projects.php",
                data: {action: 5, id_project: id_project},
                success: function(response) {
                    $('#projects-content').html(response);
                }
            });
        },200);
    });

    function add_post_project() {
        let id_project = $('.map').attr('id').replace('map','');
        let activity = $('#publish-project-select').find(":selected").val();
        let desc = $('#md-modal-publish-project-input').val();
        $.ajax({
            type: 'POST',
            url:  localStorage.getItem("web")+"/php/projects.php",
            data: {action: 7, id_project: id_project, desc: desc,activity:activity},
            success: function() {
                    window.location=localStorage.getItem("web")+"/user/<?php echo $_SESSION['nickname']; ?>";
            }
        });
    }



    $(document).on('click','#projects-list-item-text',function () {
        if($(this).hasClass('add-project'))return;
        let id_project = $(this).parent().attr('class').split('-')[1];
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
<script src="<?php echo $web?>/js/meteorEmoji.min.js"></script>
<script>
    (() => {
        new MeteorEmoji()
    })()
</script>

<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/projects.js"></script>
<script src="<?php echo $web ?>/js/modalEffects.js"></script>
<script src="<?php echo $web ?>/js/comments.js"></script>
<script src="<?php echo $web ?>/js/post-more.js"></script>
<script src="<?php echo $web ?>/js/like.js"></script>
<script src="<?php echo $web; ?>/js/load-theme.js"></script>


</body>
</html>
