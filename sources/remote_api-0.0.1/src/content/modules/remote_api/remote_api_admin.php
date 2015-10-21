<?php
define("MODULE_ADMIN_HEADLINE", "Remote API");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "remote_api_settings");

function remote_api_admin(){
    
     if(isset($_POST["submit"])){
         if(isset($_POST["remote_api_enabled"]))
             setconfig("remote_api_enabled", "yes");
         else
             deleteconfig("remote_api_enabled");
        
         }
    
     $remote_api_enabled = getconfig("remote_api_enabled");
    
     $remote_url = "http://" . $_SERVER["SERVER_NAME"] . "/?remote";
    
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();
    ?>
<p><input name="remote_api_enabled" type="checkbox"<?php if($remote_api_enabled) echo " checked=\"checked\""?>> Aktiviert</p>
<p>Wenn UliCMS sich im Root-Verzeichnis Ihrer Domain befindet, lautet die Remote-URL in den meisten Fällen:
<br/>
<input type="text" readonly="readonly" name="remote_url" value="<?php echo $remote_url;
     ?>" onclick="this.select();" size=60>
</p>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>