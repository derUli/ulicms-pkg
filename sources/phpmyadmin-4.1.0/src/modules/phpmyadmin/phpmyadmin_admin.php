<?php
define("MODULE_ADMIN_HEADLINE", "phpMyAdmin");

$required_permission = getconfig("phpmyadmin_required_permission");

if($required_permission === false){
     $required_permission = 50;
     }

define(MODULE_ADMIN_REQUIRED_PERMISSION, $required_permission);


function phpmyadmin_admin(){
    
?>
<p><a href="<?php echo getModulePath("phpmyadmin")."phpmyadmin/"?>" target="_blank">phpMyAdmin aufrufen</a></p>
<?php 

}

?>