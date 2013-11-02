<?php
define("MODULE_ADMIN_HEADLINE", "Google Analytics");

$required_permission = getconfig("google_analytics_required_permission");

if($required_permission === false){
     $required_permission = 50;
     }

define(MODULE_ADMIN_REQUIRED_PERMISSION, $required_permission);


function google_analytics_admin(){
    
     if(isset($_POST["submit"])){
        setconfig("google_analytics_id", 
        db_escape($_POST["google_analytics_id"]));
      
      }

$ga_id = getconfig("google_analytics_id");
if(!$ga_id)
   $ga_id = "UA-XXXXX-YY";

?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Web-Property-ID: <input name="google_analytics_id" type="text" value="<?php echo htmlspecialchars($ga_id);?>"></p>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>