<?php

if(isset($_SESSION['alerts']) && !empty($_SESSION['alerts'])){

    $code = explode(":",$_SESSION['alerts']);

    if(isset($code[0]) AND !empty($code[0]) && isset($code[1]) && !empty($code[1])){

        if($code[0]=="error"){

            echo '<div class="alert" >
                  <span class="closebtn">&times;</span>  
                  ' .$lang['error'.$code[1]].
                '</div>';

        }else if($code[0]=="success"){

            echo '
                <div class="alert success" >
                   <span class="closebtn">&times;</span> 
                  '.$lang['success'.$code[1]].' 
                </div>
            ';

        }else if($code[0]=="info"){
            echo '
            <div class="alert inf" >
               <span class="closebtn">&times;</span>  
              '.$lang['info'.$code[1]].' 
            </div>          
            ';
        }

    }
    unset($_SESSION['alerts']);

}

