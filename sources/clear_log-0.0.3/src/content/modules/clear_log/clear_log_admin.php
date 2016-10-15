<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "clear_log" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "clear_log" );
function clear_log_admin() {
	if (isset ( $_POST ["submit"] )) {
		db_query ( "TRUNCATE TABLE " . tbname ( "log" ) );
	}
	
	?>
<?php

	if (isset ( $_POST ["submit"] )) {
		?>
<p><?php translate("log_cleared");?></p>
<?php }?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
	
	csrf_token_html ();
	?>
<input type="submit" name="submit"
		value="<?php translate("clear_log");?>" />
</form>
<?php
}

?>
