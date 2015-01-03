<?php
define("MODULE_ADMIN_HEADLINE", "Benutzerdefinierte CSS Regeln");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "custom_css");

function custom_css_admin(){
    
     if(isset($_POST["submit"])){
         setconfig("custom_css",
             db_escape($_POST["custom_css"]));
        
         }
    
     $custom_css = getconfig("custom_css");
     $custom_css = stringHelper :: real_htmlspecialchars($custom_css);
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Hier können Sie eigene CSS Regeln definieren, ohne den Code der Templates modifizieren zu müssen.<br/>
</p>
<p>
<textarea rows="30" cols="80" style="width:100%" name="custom_css"><?php echo $custom_css;
     ?></textarea>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>