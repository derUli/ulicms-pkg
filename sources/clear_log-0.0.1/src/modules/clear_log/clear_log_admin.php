<?php
define("MODULE_ADMIN_HEADLINE", "Protokoll leeren");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "clear_log");

function clear_log_admin(){
     if(isset($_POST["submit"]))
        db_query("TRUNCATE TABLE ".tbname("log")); 
     
    
    
    
     ?>
<?php if(isset($_POST["submit"])){
?>
<p>Protokoll wurde erfolgreich geleert.</p>
<?php }?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();
    ?>
<input type="submit" name="submit" value="Protokoll leeren"/>
</form>
<?php
     }

 ?>
