<?php
define("MODULE_ADMIN_HEADLINE", "phpMyAdmin");
define(MODULE_ADMIN_REQUIRED_PERMISSION, "phpmyadmin");


function phpmyadmin_admin(){
    
    ?>
<p><a href="<?php echo getModulePath("phpmyadmin") . "phpmyadmin/"?>" target="_blank">phpMyAdmin aufrufen</a></p>
<?php
    
    }

?>