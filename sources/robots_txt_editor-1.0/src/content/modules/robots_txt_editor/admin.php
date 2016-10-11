<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "robots_txt_editor" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "robots_txt_editor" );
function robots_txt_editor_admin() {
	$file = ULICMS_ROOT . "/robots.txt";
	$text = $_POST ["text"];
	if (isset ( $_POST ["submit"] )) {
		file_put_contents ( $file, $text );
	}
	if (file_exists ( $file )) {
		$text = file_get_contents ( $file );
		$text = stringHelper::real_htmlspecialchars ( $text );
	} else {
		$text = "";
	}
	?>
<form action="<?php echo getModuleAdminSelfPath();?>" method="post">
<?php csrf_token_html ();?>
<p>
		<a href="http://www.robotstxt.org/" target="_blank"><?php translate("about_robots_txt"); ?></a><br />
	</p>

	<textarea id="text" rows="30" cols="80" style="width: 100%" name="text"><?php echo $text;?></textarea>


	<p>
		<input type="submit" name="submit"
			value="<?php translate("save_changes");?>" />
	</p>
</form>
<?php
}

?>
