<?php
    require '../config/lang.php';

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
    <div class="title">
        <h1><?php echo $lang['reset_your_password'] ?></h1><br><br>

    </div>
    <form action="<?php echo $web ?>/php/forgot.php" method="post">
        <div class="field-wrap">
            <label>
                <?php echo $lang['email_address'] ?><span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email"/><br><br>
        </div>
        <button class="button button-block"/><?php echo $lang['reset'] ?></button>
    </form>
</div>

<div id="alerts">
    <?php require '../php/alerts.php'; ?>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

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
