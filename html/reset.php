<?php
    echo require '../config/lang.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $lang['title_reset'] ?></title>
        <link rel="stylesheet" href="<?php echo $web ?>/css/index.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/alerts.css">

        <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-select.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-skin-elastic.css" />
    </head>

    <body>

    <div id="lang">
        <select class="cs-select cs-skin-elastic" id="mySelect">
            <option value="" disabled ><?php echo $lang['select_a_country'] ?></option>
            <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="en")echo "selected"; ?> data-class="flag-sk"><?php echo $lang['en'] ?></option>
            <option value="sk" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="sk")echo "selected"; ?> data-class="flag-en"><?php echo $lang['sk'] ?></option>
        </select>
    </div>

    <div class="form">

        <h1><?php echo $lang['choose'] ?></h1>

        <form action="<?php echo $web ?>/php/reset_password.php" method="post">

            <div class="field-wrap">
                <label>
                    <?php echo $lang['new_password'] ?><span class="req">*</span>
                </label>
                <input type="password" minlength=5 required name="newpassword" autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <label>
                    <?php echo $lang['confirm_password'] ?><span class="req">*</span>
                </label>
                <input type="password" minlength=5 required name="confirmpassword" autocomplete="off"/>
            </div>

            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="hash" value="<?= $hash ?>">

            <button class="button button-block"/><?php echo $lang['apply'] ?></button>

        </form>

    </div>


    <div id="alerts">
        <?php require '../php/alerts.php'; ?>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php echo $web?>/js/index.js"></script>
    <script>
        var close = document.getElementsByClassName("closebtn");
        var i;

        for (i = 0; i < close.length; i++) {
            close[i].onclick = function(){
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function(){ div.style.display = "none"; }, 600);
            }
        }
    </script>
    <script src="<?php echo $web ?>/js/classie.js"></script>
    <script src="<?php echo $web ?>/js/selectFx.js"></script>
    <script>
        (function() {
            [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
                new SelectFx(el);
            } );
        })();
    </script>

    </body>
</html>