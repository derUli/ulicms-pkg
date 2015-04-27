<?php
function phpContact_render(){
   $file = ULICMS_ROOT."/phpContact/index.php";
   $retval = "<span class=\"ulicms_error\">Bitte installieren Sie zuerst phpContact nach ".$file.".</span>";
   if(is_file($path)){
     ob_start();
     include_once $file;
     $retval = ob_get_clean();
 
   }
    return $retval;
}
