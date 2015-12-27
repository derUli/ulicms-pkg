<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "search_settings" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "search_settings" );
function search_admin() {
	if (isset ( $_POST ["submit"] )) {
		if (isset ( $_POST ["search_enable_boolean_mode"] )) {
			setconfig ( "search_enable_boolean_mode", "search_enable_boolean_mode" );
		} else {
			deleteconfig ( "search_enable_boolean_mode" );
		}
	}
	?>
<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();?>
<p>
		<input type="checkbox" name="search_enable_boolean_mode"
			id="search_enable_boolean_mode" value="search_enable_boolean_mode"
			<?php if(getconfig("search_enable_boolean_mode")) echo "checked";?>>
		<label for="search_enable_boolean_mode"><?php translate("enable_boolean_mode");?></label>
	</p>
	<p>
		<input name="submit" type="submit"
			value="<?php translate("save_changes");?>">
	</p>
</form>
<?php
     }

?>
