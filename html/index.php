<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';
?>

<html xmlns="http://www.w3.org/1999/html">

    <head>
        <title><?php echo $lang['title_index'] ?></title>
        <link rel="stylesheet" href="<?php echo $web ?>/css/index.css">
        <link rel="stylesheet" href="<?php echo $web ?>/css/alerts.css">

        <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-select.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/cs-skin-elastic.css" />

    </head>

    <body>

    <div id="lang">
        <select onchange="changePass()" class="cs-select cs-skin-elastic" id="mySelect">
            <option value="" disabled ><?php echo $lang['select_a_country'] ?></option>
            <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="en")echo "selected"; ?> data-class="flag-sk"><?php echo $lang['en'] ?></option>
            <option value="sk" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="sk")echo "selected"; ?> data-class="flag-en"><?php echo $lang['sk'] ?></option>
        </select>
    </div>

    <div class="form">

        <ul class="tab-group">
            <li class="tab active"><a href="#login"><?php echo $lang['log_in'] ?></a></li>
            <li class="tab"><a href="#signup"><?php echo $lang['sign_up'] ?></a></li>
        </ul>

        <div class="tab-content">

            <div id="login">
                <div class="title">
                    <h7><?php echo $lang['title_index'] ?></h7><br><br>
                </div>
                <form action="<?php echo $web ?>/php/login.php" method="post" autocomplete="off">

                    <div class="field-wrap">
                        <label  id="label-login-nick">
                            <?php echo $lang['email_address'] ?><span class="req">*</span>
                        </label>
                        <input type="email" required autocomplete="off" id="form-login-nick" name="email"/>
                    </div>

                    <div class="field-wrap">
                        <label id="label-login-password">
                            <?php echo $lang['password'] ?><span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" id="form-login-password" name="password"/>
                    </div>

                    <p class="forgot"><a href="forgot"><?php echo $lang['forgot_password'] ?></a></p>

                    <button class="button button-block" name="login" /><?php echo $lang['log_in'] ?></button>

                </form>

            </div>

            <div id="signup">
                <div class="title">
                    <h7><?php echo $lang['title_index'] ?></h7><br><br>
                </div>

                <form action="<?php echo $web ?>/php/register.php" method="post" autocomplete="off">

                    <div class="top-row">
                        <div class="field-wrap">
                            <label>
                                <?php echo $lang['first_name'] ?><span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='firstname' />
                        </div>

                        <div class="field-wrap">
                            <label>
                                <?php echo $lang['last_name'] ?><span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='lastname' />
                        </div>
                    </div>

                    <div class="field-wrap">
                        <label>
                            <?php echo $lang['nick_name'] ?><span class="req">*</span>
                        </label>
                        <input type="text" minlength="3" required maxlength="20" autocomplete="off" name='nickname'/>
                    </div>

                    <div class="field-wrap">
                        <label id="label-register-nick">
                            <?php echo $lang['email_address'] ?><span class="req">*</span>
                        </label>
                        <input type="email" required autocomplete="off" id="form-register-nick" name='email' />
                    </div>

                    <div class="field-wrap">
                        <label id="label-register-password">
                            <?php echo $lang['password'] ?><span class="req">*</span>
                        </label>
                        <input id="inputPassword" minlength=5 type="password" required autocomplete="off" name='password'/>

                        <div style="text-align: center">
                            <div id="strong" style="display:inline-block;">

                            </div>

                            <div  class="showPass" style="display:inline-block;">
                                <img src="<?php echo $web ?>/img/show_hide_password.png" id="showPass" title="<?php echo $lang['show_password'] ?>" onclick="changePass()">
                            </div>
                        </div>

                    </div>
                    <br>
                    <div>
                        <button type="submit" class="button button-block" name="register" /><?php echo $lang['sign_up'] ?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <div id="timezone">
    </div>
    <div id="alerts">
        <?php require '../php/alerts.php'; ?>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php echo $web ?>/js/index.js"></script>
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
    <script>
        function changePass() {
            var input = document.getElementById("inputPassword");
            if(input.type == "password"){
                input.type = "text";
            }else{
                input.type = "password";
            }
        }
    </script>
    <script src="<?php echo $web ?>/js/pass_strong.js"></script>
    <script src="<?php echo $web ?>/js/classie.js"></script>
    <script src="<?php echo $web ?>/js/selectFx.js"></script>
    <script>
        (function() {
            [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
                new SelectFx(el);
            } );
        })();
    </script>
    <script>
        var currentTime = new Date();
        var date = currentTime.getTimezoneOffset();
        $(document).ready(function () {
            $("#timezone").load(localStorage.getItem("web")+"/php/timezone.php", {date: date});
        });

    </script>
    </body>

</html>




