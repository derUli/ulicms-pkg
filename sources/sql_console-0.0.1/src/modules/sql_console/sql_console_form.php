<?php
if(!defined("MODULE_ADMIN_REQUIRED_PERMISSION"))
     die("Lam0r! ^^");
?>
<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();
?>
<p><textarea name="sql_code" id="sql_code"><?php echo htmlspecialchars($_SESSION["sql_code"])?></textarea></p>
<input type="submit" value="Ausführen">
</form>