<?php
define("MODULE_ADMIN_HEADLINE", "Permanente Weiterleitungen");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "redirections301_edit");

function redirections301_admin(){
    
     if(isset($_POST["submit"])){
         setconfig("redirections301",
             db_escape($_POST["redirections301"]));
        
         }
    
     $redirections301 = getconfig("redirections301");
     $redirections301 = stringHelper :: real_htmlspecialchars($redirections301);
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p>Hier können Sie permanente Weiterleitungen (HTTP Status 301) einrichten.<br/>
Sie können je einen Eintrag pro Zeile eingeben.</p>
<p>Die Einträge müssen im folgenden Format erfolgen:<br/>
/?seite=alte_seite&amp;parameter=beispiel=&gt;http://www.neuedomain.de/kategorie/seite.html</p>

<br/>
<p>
<textarea rows="10" cols="80" style="width:100%" name="redirections301"><?php echo $redirections301;
     ?></textarea>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
</form>
<?php
     }

?>