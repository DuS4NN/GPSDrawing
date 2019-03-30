<?php
session_start();
require '../config/db.php';
require '../config/lang.php';


if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    header("location: ".$web."/home");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lang['title_index'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-skin-elastic.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/index2.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/alerts-main.css"/>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>

</head>
<body>
<div id="container-main-page">

    <div id="main-page-header">
        <div id="main-page-header-title">
            <a href="<?php echo $web?>/welcome"><?php echo $lang['title_index']; ?></a>
        </div>

        <div id="main-page-header-lang">
            <div id="lang">
                <select onchange="changePass()" class="cs-select cs-skin-elastic" id="mySelect">
                    <option value="" disabled ><?php echo $lang['select_a_country'] ?></option>
                    <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="en")echo "selected"; ?> data-class="flag-sk"><?php echo $lang['en'] ?></option>
                    <option value="sk" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="sk")echo "selected"; ?> data-class="flag-en"><?php echo $lang['sk'] ?></option>
                </select>
            </div>
        </div>
    </div>

    <div id="main-page-content-container">

        <div id="main-page-content-form">
            <div id="main-page-content-form-container">

                <div id="main-page-content-form-container-title">
                    <?php echo $lang['title_reset']; ?>
                </div>

                <div id="main-page-content-form-container-formular">
                    <form action="<?php echo $web?>/php/forgot.php" method="post" autocomplete="off">
                        <div id="formular-line">
                            <div id="formular-a-label"><?php echo $lang['email_address']; ?></div>
                            <input name="email" type="email" minlength="5" required placeholder="<?php echo $lang['enter_email']; ?>"/>
                        </div>

                </div>
                <div id="main-page-content-form-container-button">
                    <button type="submit" class="main-login-button">

                        <div id="button-title">
                            <?php echo $lang['reset']; ?>
                        </div>

                        <div id="button-arrow">
                            <div class="round">
                                <div id="cta">
                                    <span class="arrow primera next "></span>
                                    <span class="arrow segunda next "></span>
                                </div>
                            </div>
                        </div>

                    </button>
                </div>

                </form>

            </div>
        </div>

        <div id="main-page-content-info">
            <div id="main-page-content-info-text">

                <div id="main-page-content-info-text-title">
                    <?php echo $lang['forgot_password']; ?>
                </div>

                <div id="main-page-content-info-text-text">
                    <?php echo $lang['forgot_desc1'] ?><br><br>
                    <?php echo $lang['forgot_desc2'] ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="timezone">
</div>
<div id="alerts">
    <?php require '../php/alerts.php'; ?>
</div>


<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/selectFx.js"></script>
<script>

    $(document).on('click','.main-login-button.reg',function () {
        window.location.replace('<?php echo $web;?>/register');
    });

    //Select
    (function() {
        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
            new SelectFx(el);
        } );
    })();

    //Close alert
    let close = document.getElementsByClassName("closebtn");
    for (let i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            closeAlert('remove');
            setTimeout(function(){ div.style.display = "none"; }, 600);


        }
    }

</script>


</body>
</html>