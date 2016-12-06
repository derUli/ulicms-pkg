<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation("android_toolbar_color") );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "android_toolbar_color");
function android_toolbar_color_admin() {
	if(isset($_POST["android_toolbar_color"])){
		Settings::set("android_toolbar_color", $_POST["android_toolbar_color"]);
	}
	?>
<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
	<p><strong><?php translate("android_toolbar_color");?></strong><br /> <input name="android_toolbar_color"
				class="color {hash:true,caps:true}"
				value="<?php
	
	echo real_htmlspecialchars ( Settings::get ( "android_toolbar_color" ) );
	?>">
	</p>
	<p><input type="submit" value="<?php translate("save_changes");?>">
	</p>
	<?php csrf_token_html();?>
</form>
<?php
}

?>
