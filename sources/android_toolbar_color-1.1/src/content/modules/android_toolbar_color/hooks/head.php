<?php
   $android_toolbar_color = Settings::get("android_toolbar_color");
   if($android_toolbar_color){
?>
<!-- Android -->
<meta name="theme-color" content="<?php Template::escape($android_toolbar_color);?>" />  
<!-- Windows Phone -->  
<meta name="msapplication-navbutton-color" content="<?php Template::escape($android_toolbar_color);?>" />  

   <?php } 