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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3.33&key=AIzaSyC4OeJ9LmgWvXBeGXwy1rUjj4zPxcEAqe8&language=<?php echo $_SESSION['lang']?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/index2.css" />
    <script src="<?php echo $web; ?>/js/load-theme.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div id="container-main-page">
    <script>

        let styledMapType = get_theme(Math.floor(101+Math.random() * 14));
        //101 - 114

        let map = new google.maps.Map(document.getElementById('container-main-page'), {
            mapTypeControlOptions: {
                mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
            },
            disableDefaultUI: true,
            center: {lat: 40.674, lng: 0},
            zoom: 3,

        });
        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
    </script>
    <div id="main-page-header">
        <div id="main-page-header-logo">
            <div id="lang">
                <select onchange="changePass()" class="cs-select cs-skin-elastic" id="mySelect">
                    <option value="" disabled ><?php echo $lang['select_a_country'] ?></option>
                    <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="en")echo "selected"; ?> data-class="flag-sk"><?php echo $lang['en'] ?></option>
                    <option value="sk" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="sk")echo "selected"; ?> data-class="flag-en"><?php echo $lang['sk'] ?></option>
                </select>
            </div>
        </div>
        <div id="main-page-header-title">
                <span class="main-title">
                    <a href="<?php echo $web;?>/welcome"><?php echo $lang['title_index']; ?></a>
                </span>

        </div>
        <div id="main-page-header-links">
                <span class="info-button">
                    <a href="<?php echo $web; ?>/welcome" ><?php echo $lang['log_in']; ?> </a>
                </span>

            <span class="info-button">
                    <a href="<?php echo $web; ?>/register"> <?php echo $lang['sign_up']; ?> </a>
                </span>

            <span class="info-button about">
                    <a href="<?php echo $web; ?>/about"> <?php echo $lang['about']; ?> </a>
                </span>

        </div>
    </div>


    <div id="main-page-content">
        <div id="main-page-login" class="form">
            <div id="main-page-login-title">
                <?php echo $lang['sign_up']?>
            </div>

            <div id="register-form-container">

                <div id="register-form-line">
                    <div id="register-form-a">
                        <span id="nickname"><?php echo $lang['first_name'];?></span><br>
                        <input type="text" placeholder="<?php echo $lang['enter_fname'];?>" name="f-name" minlength="3" required />
                    </div>
                    <div id="register-form-b">
                        <span id="nickname"><?php echo $lang['last_name'];?></span><br>
                        <input type="text" placeholder="<?php echo $lang['enter_lname'];?>" name="l-name" minlength="3" required />
                    </div>
                </div>

                <div id="register-form-line">
                    <div id="register-form-a">
                        <span id="nickname"><?php echo $lang['nick_name'];?></span><br>
                        <input type="text" placeholder="<?php echo $lang['enter_nick'];?>" name="nick" minlength="3" required />
                    </div>
                    <div id="register-form-b">
                        <span id="nickname"><?php echo $lang['email_address'];?></span><br>
                        <input type="text" placeholder="<?php echo $lang['enter_email'];?>" name="email" minlength="3" required />
                    </div>
                </div>

                <div id="register-form-line">
                    <div id="register-form-a" class="last">
                        <span id="nickname"><?php echo $lang['password'];?></span><br>
                        <input type="password" placeholder="<?php echo $lang['enter_pass'];?>" name="password" minlength="3" required />
                    </div>
                    <div id="register-form-b" class="last">
                        <span id="nickname"><?php echo $lang['password'];?></span><br>
                        <input type="password" placeholder="<?php echo $lang['enter_pass2'];?>" name="repassword" minlength="3" required />
                    </div>
                </div>

            </div>




            <div id="main-page-login-button" class="reg">
                <div id="register-button" class="login-button-form">
                    <?php echo $lang['sign_up'] ?>
                </div>
                <div id="register-button-arrow" class="login-button-form">
                    <div class="round">
                        <div id="cta">
                            <span class="arrow primera next "></span>
                            <span class="arrow segunda next "></span>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div id="main-page-login" class="side">
            <div id="main-page-login-reg-title">
                <?php echo $lang['member3'] ?><BR>
                <?php echo $lang['member4'] ?>
            </div>

            <div id="main-page-login-reg-desc">
                <?php echo $lang['member_desc3']; ?>
                <br><br>
                <?php echo $lang['member_desc4'];?>


            </div>

            <div id="main-page-login-reg-button">
                <div id="register-button">
                    <?php echo $lang['log_in']; ?>
                </div>
                <div id="register-button-arrow">
                    <div class="round2">
                        <div id="cta2">
                            <span class="arrow2 primera2 next2 "></span>
                            <span class="arrow2 segunda2 next2 "></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<script src="<?php echo $web ?>/js/classie.js"></script>
<script src="<?php echo $web ?>/js/selectFx.js"></script>
<script>
    (function() {
        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
            new SelectFx(el);
        } );
    })();


    $(document).on('click','#main-page-login-reg-button',function () {
        window.location.replace('<?php echo $web;?>/welcome');
    });


    function initMap() {
        var map = new google.maps.Map(document.getElementById('container-main-page'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }




</script>


</body>
</html>