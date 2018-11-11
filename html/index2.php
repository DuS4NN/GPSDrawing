<?php
    session_start();
    require '../config/db.php';
    require '../config/lang.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $web ?>/css/index2.css" />
</head>
<body>
    <div id="container-main-page">
        <div id="main-page-header">
            <div id="main-page-header-logo">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div id="main-page-header-title">
                <?php echo $lang['title_index']; ?>
            </div>
            <div id="main-page-header-links">
                <span class="info-button">
                    <?php echo $lang['log_in']; ?>
                </span>

                <span class="info-button">
                    <?php echo $lang['about']; ?>
                </span>

                <span class="info-button lang">
                   <?php echo $_SESSION['lang']; ?>
                </span>
            </div>
        </div>


        <div id="main-page-content">
            <div id="main-page-login" class="form">
                <div id="main-page-login-title">
                    <?php echo $lang['log_in']?>
                </div>

                <div id="main-page-login-form">
                    <span id="nickname">Nick name</span><br>
                    <input type="text" placeholder="Enter your nick name" name="nick" minlength="3" required />
                </div>

                <div id="main-page-login-form">
                    <span id="password">Password</span><br>
                    <input type="password" placeholder="Enter your password" name="password" minlength="3" required />
                </div>


            </div>

            <div id="main-page-login" class="side">
                <div id="main-page-login-reg-title">
                        NOT A<BR>
                        MEMBER ?
                </div>

                <div id="main-page-login-reg-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer mollis orci eu nisl lacinia, sit amet vestibulum sem aliquam.<br><br>
                    Nam aliquet, augue ut tincidunt finibus, arcu tortor feugiat diam, nec placerat nisi sapien vitae orci.

                </div>

                <div id="main-page-login-reg-button">
                    <div id="register-button">
                        REGISTER NOW
                    </div>
                    <div id="register-button-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>
</html>