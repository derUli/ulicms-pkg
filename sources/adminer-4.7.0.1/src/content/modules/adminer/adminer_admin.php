<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "adminer" ) );
define ( MODULE_ADMIN_REQUIRED_PERMISSION, "adminer" );

function adminer_admin() {
	$cfg = new CMSConfig();
	?>
	<form id="adminer-form" method="post" action="<?php echo ModuleHelper::buildModuleRessourcePath("adminer", "index.php");?>">
	<input type="hidden" name="auth[server]" value="<?php esc($cfg->db_server);?>">
	<input type="hidden" name="auth[username]" value="<?php esc($cfg->db_user);?>">
	<input type="hidden" name="auth[password]" value="<?php esc($cfg->db_password);?>">
	<input type="hidden" name="auth[db]" value="<?php esc($cfg->db_database);?>">
	<input type="hidden" name="auth[driver]" value="server">
	<!-- <button type="submit" class="btn btn-primary"><?php translate("open_adminer");?></button> -->
	</form>
<script>
	$(function(){
		var form = $("#adminer-form");
		document.getElementsByTagName('title')[0].innerHTML = 'Adminer';
		window.history.replaceState( {} , 'Adminer', form.attr("url") );
		form.submit();
	});
	</script>
<?php
}
