<?php

if(isset($_SESSION['alerts']) && !empty($_SESSION['alerts'])){

    $code = explode(":",$_SESSION['alerts']);

    if(isset($code[0]) AND !empty($code[0]) && isset($code[1]) && !empty($code[1])){

        if($code[0]=="error"){
            echo '<div class="alert remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['error'.$code[1]].'</div><script>closeAlert("remove"); </script>';
        }else if($code[0]=="success"){
            echo '<div class="alert success remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['success'.$code[1]].'</div><script>closeAlert("remove"); </script>';
        }else if($code[0]=="info"){
            echo '<div class="alert info remove" id="alert-main-post"><span class="closebtn">&times;</span>'.$lang['info'.$code[1]].'</div><script>closeAlert("remove"); </script>';
        }

    }
    unset($_SESSION['alerts']);

}

