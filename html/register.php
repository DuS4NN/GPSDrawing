<?php
session_start();
require '../config/db.php';
require '../config/lang.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $lang['title_index'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-skin-elastic.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/alerts-main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/register.css"/>
    <script src="<?php echo $web ?>/js/alerts-main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback" async defer></script>
    <script>
        //Recaptcha
        var onloadCallback = function() {
            grecaptcha.execute();
        };

        function setResponse(response) {
            document.getElementById('captcha-response').value = response;
        }
    </script>

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
                    <?php echo $lang['sign_up']; ?>
                </div>

                <form action="<?php echo $web; ?>/php/register.php" id="i-recaptcha" method="post" autocomplete="off">

                    <div id="main-page-content-form-container-formular">

                        <div id="formular-line">

                            <div id="formular-line-a">
                                <div id="formular-a-label"><?php echo $lang['first_name']; ?></div>
                                <input type="text" name="firstname" required placeholder="<?php echo $lang['enter_fname']; ?>"/>
                            </div>

                            <div id="formular-line-b">
                                <div id="formular-a-label"><?php echo $lang['last_name']; ?></div>
                                <input type="text" name="lastname" required placeholder="<?php echo $lang['enter_lname']; ?>"/>
                            </div>

                        </div>

                        <div id="formular-line">

                            <div id="formular-line-a">
                                <div id="formular-a-label"><?php echo $lang['nick_name']; ?></div>
                                <input type="text" name="nickname" required minlength="5" placeholder="<?php echo $lang['enter_nick']; ?>"/>
                            </div>

                            <div id="formular-line-b">
                                <div id="formular-a-label"><?php echo $lang['email_address']; ?></div>
                                <input type="email" name="email" required minlength="5" placeholder="<?php echo $lang['enter_email']; ?>"/>
                            </div>

                        </div>

                        <div id="formular-line">

                            <div id="formular-line-a" class="last">
                                <div id="formular-a-label" ><?php echo $lang['password']; ?></div>
                                <input type="password" name="password" required minlength="4" placeholder="<?php echo $lang['enter_pass']; ?>"/>
                            </div>

                            <div id="formular-line-b" class="last">
                                <div id="formular-a-label" ><?php echo $lang['confirm_pass']; ?></div>
                                <input type="password" name="confirmpassword" required minlength="4" placeholder="<?php echo $lang['enter_pass2']; ?>"/>
                            </div>

                        </div>

                    </div>

                    <div id="main-page-content-form-container-button">
                        <button class="main-login-button" type="submit">
                            <div id="button-title">
                                <?php echo $lang['sign_up']; ?>
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

                    <div class="g-recaptcha" data-sitekey="6LfQ03wUAAAAAB3OUrzjOb6IJyDOG7_1Cb5dP548" data-size="invisible" data-callback="setResponse"></div>

                    <input type="hidden" id="captcha-response" name="captcha-response" />

                </form>

            </div>
        </div>
    </div>

</div>


<div id="alerts">
    <?php require '../php/alerts.php'; ?>
</div>


<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/selectFx.js"></script>
<script>
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