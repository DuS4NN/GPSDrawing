<?php
    session_start();
    $dateU = $_POST['date'];
    $_SESSION['time'] = $dateU/60*3600*(-1);
    echo $_SESSION['time'];
