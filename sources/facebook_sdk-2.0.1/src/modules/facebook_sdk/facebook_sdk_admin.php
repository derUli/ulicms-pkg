<?php
define("MODULE_ADMIN_HEADLINE", "Facebook SDK");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "facebook_api_settings");

function facebook_sdk_admin(){
    
     if(isset($_POST["submit"])){
         setconfig("facebook_app_id",
             db_escape($_POST["facebook_app_id"]));
        
         }
    
     $facebook_app_id = getconfig("facebook_app_id");
     if(!$facebook_app_id)
         $ga_id = "";
    
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Facebook APP-ID: <input name="facebook_app_id" required="true" type="text" value="<?php echo htmlspecialchars($facebook_app_id);
     ?>"></p>
<p><a href="https://developers.facebook.com/">Get an APP-ID / Eine APP-ID beantragen</a></p>
<p><input type="submit" name="submit" value="<?php translate("SAVE_CHANGES")"/></p>
</form>
<?php
     }

?>