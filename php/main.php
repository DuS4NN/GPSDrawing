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
    <?php if($_SESSION['night_mode']==1)echo '<link rel="stylesheet" href="'.$web.'/css/dark_mode.css">';?>
    <link rel="stylesheet" href="<?php echo $web ?>/css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="<?php echo $web; ?>/js/load-theme.js"></script>
    <script src="<?php echo $web ?>/js/load-map.js"></script>
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&language=<?php echo $_SESSION['lang']?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>



</head>
<body>

    <?php require '../html/header.html'; ?>

    <table id="main-nav-bar" border="0">
        <tr>
            <td align="bottom">
                <div id="main-nav-item" class="following selected">
                    <img id="main-nav-img" src="https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '1ab188'; else echo '1ab188'; ?>/following.png"><span id="main-nav-text"><?php echo $lang['following'];?></span>
                </div>
            </td>
            <td>
                <div id="main-nav-item" class="trends">
                    <img id="main-nav-img" src="https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/gas.png"><span id="main-nav-text"><?php echo $lang['trends'];?></span>
                </div>
            </td>
            <td>
                <div id="main-nav-item" class="recommended">
                    <img id="main-nav-img" src="https://png.icons8.com/material-outlined/90/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/star.png"> <span id="main-nav-text"><?php echo $lang['recommended'];?></span>
                </div>
            </td>
            <td>
                <div id="main-nav-item" class="new">
                    <img id="main-nav-img" src="https://png.icons8.com/ios-glyphs/90/<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>/activity-feed-2.png"><span id="main-nav-text"><?php echo $lang['new'];?></span>
                </div>
            </td>
        </tr>
    </table>

    <div id="body" style="width: 100%; left:0;">


        <script>
            $.ajax({
                type:"POST",
                url: "<?php echo $web; ?>/php/load_posts.php",
                data:{action:'following',limit:0,end_limit:5},
                success:function(response){
                    $("#body").append(response);
                    if(response.length<100){
                        $(window).unbind('scroll DOMMouseScroll');
                    }
                }
            });
        </script>

    </div>

    <script>
        let limit = 5;
        let old_item_class = "following";
        let click = true;

        $(document).on('click','#main-nav-item',function (e) {
            if(e.target.id === 'main-nav-item')return;
            let new_item_class = e['target'].parentElement.className.replace(" selected","");
            if(new_item_class===old_item_class)return;

            let new_item = $('.'+new_item_class);
            let old_item = $('.'+old_item_class);

            let new_item_src = $(new_item).children().attr('src');
            let old_item_src = $(old_item).children().attr('src');

            $(new_item).children().attr('src',new_item_src.replace('<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>','1ab188'));
            $(old_item).children().attr('src',old_item_src.replace('1ab188','<?php if($_SESSION['night_mode']==1)echo '505050'; else echo 'bbbbbb'; ?>'));


            $('.selected').removeClass('selected');
            $(new_item).addClass('selected');
            old_item_class=new_item_class;

            $.ajax({
                type:"POST",
                url: "<?php echo $web; ?>/php/load_posts.php",
                data:{action:new_item_class,limit:0,end_limit:5},
                success:function(response){
                    $("#body").html(response);
                    if(response.length<100){
                        $(window).unbind('scroll DOMMouseScroll');
                    }
                }
            });

            $(window).bind('scroll DOMMouseScroll', onscroll);
            limit=5;

        });

        $(window).bind('scroll DOMMouseScroll', onscroll);

        function onscroll() {
            if(!click){
                return;
            }
            if($(window).scrollTop() + window.innerHeight >= getDocHeight()) {
                setTimeout(function () {
                    $.ajax({
                        type:"POST",
                        url: "<?php echo $web; ?>/php/load_posts.php",
                        data:{action:old_item_class,limit:limit,end_limit:1},
                        success:function(response){
                            $("#body").append(response);
                            if(response.length<100){
                                $(window).unbind('scroll DOMMouseScroll');
                            }
                        }
                    });
                    limit++;
                    click=false;
                    setTimeout(function () {
                        click=true;
                    },100);
                },0);
            }
        }

        function getDocHeight() {
            let D = document;
            return Math.max(
                D.body.scrollHeight, D.documentElement.scrollHeight,
                D.body.offsetHeight, D.documentElement.offsetHeight,
                D.body.clientHeight, D.documentElement.clientHeight
            )-150;
        }

        if (window.performance) {
            $( "body" ).scrollTop(0);
        }
    </script>

    <div id="alerts-2">
        <?php require '../php/alerts.php'; ?>
    </div>


    <?php require '../html/modals.html'; ?>


    <div id="overlay" class="md-overlay"></div>


    <script src="<?php echo $web ?>/js/classie.js"></script>
    <script src="<?php echo $web ?>/js/modalEffects.js"></script>
    <script src="<?php echo $web ?>/js/comments.js"></script>
    <script src="<?php echo $web ?>/js/post-more.js"></script>
    <script src="<?php echo $web ?>/js/like.js"></script>



</body>
</html>
