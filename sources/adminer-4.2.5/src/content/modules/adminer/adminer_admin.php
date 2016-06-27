<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation("adminer") );
define ( MODULE_ADMIN_REQUIRED_PERMISSION, "adminer" );
function adminer_admin() {
	?>
<p>
	<a href="<?php echo getModulePath("adminer")."index.php";?>"
		target="_blank"><?php translate("open_adminer");?></a>
</p>
<?php
}

?>
