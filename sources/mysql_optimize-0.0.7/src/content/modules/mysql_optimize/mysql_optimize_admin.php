<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "OPTIMIZE_DATABASE" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "mysql_optimize" );
function mysql_optimize_admin() {
	if (isset ( $_POST ["submit"] )) {
		include_once getModulePath ( "mysql_optimize" ) . "mysql_optimize_lib.php";
		$cfg = new config ();
		db_optimize ( $cfg->db_database );
	}
	
	?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
	
	csrf_token_html ();
	?>
<input type="submit" name="submit"
		value="<?php translate("OPTIMIZE_AND_UPDATE_DATABASE");?>" />
</form>
<?php
}

?>
