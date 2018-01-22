<?php
define("MODULE_ADMIN_HEADLINE", get_translation("custom_admin_css_title"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "custom_admin_css");

function custom_admin_css_admin()
{
    if (isset($_POST["submit"])) {
        setconfig("custom_admin_css", db_escape($_POST["custom_admin_css"]));
    }
    
    $custom_admin_css = getconfig("custom_admin_css");
    $custom_admin_css = stringHelper::real_htmlspecialchars($custom_admin_css);
    ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html();
    ?>
<p>
		<?php translate("custom_admin_css_help")?><br />
	</p>
	<p>
		<textarea rows="30" cols="80" style="width: 100%"
			name="custom_admin_css"><?php
    
    echo $custom_admin_css;
    ?></textarea>
	
	
	<p>
		<button type="submit" name="submit" class="btn btn-success"><?php translate("save_changes");?></button>
	</p>
</form>
<?php
}

?>