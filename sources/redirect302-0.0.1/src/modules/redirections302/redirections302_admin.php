<?php
define("MODULE_ADMIN_HEADLINE", "Permanente Weiterleitung");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "redirections302_edit");

function redirections302_admin(){
    
     if(isset($_POST["submit"])){
         setconfig("redirections302",
             db_escape($_POST["redirections302"]));
        
         }
    
     $redirections302 = getconfig("redirections302");
     $redirections302 = stringHelper :: real_htmlspecialchars($redirections302);
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Hier können Sie permanente Weiterleitungen (HTTP Status 302) einrichten.<br/>
Sie können je einen Eintrag pro Zeile eingeben.</p>
<p>Die Einträge müssen im folgenden Format erfolgen:<br/>
/?seite=alte_seite&amp;parameter=beispiel=&gt;http://www.neuedomain.de/kategorie/seite.html</p>

<br/>
<p>
<textarea rows="10" cols="80" style="width:100%" name="redirections302"><?php echo $redirections302;
     ?></textarea>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>