<?php
define("MODULE_ADMIN_HEADLINE", "Datenbanken optimieren");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "mysql_optimize");

function mysql_optimize_admin(){
     if(isset($_POST["submit"])){
         include_once getModulePath("mysql_optimize") . "mysql_optimize_lib.php";
         $cfg = new config();
         db_optimize($cfg -> db_database);
         }
    
    
    
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<input type="submit" name="submit" value="Datenbank optimieren und reparieren"/>
</form>
<?php
     }

 ?>
