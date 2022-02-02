<?php
define("MODULE_ADMIN_HEADLINE", "Redirect on 404");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "redirect_on_404");
function redirect_on_404_admin()
{
    if (isset($_POST ["submit"])) {
        setconfig("redirect_on_404_to", db_escape($_POST ["redirect_on_404_to"]));
    }
    
    $redirect_on_404_to = getconfig("redirect_on_404_to");
    $pages = getAllPagesWithTitle(); ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html(); ?>
<p>
		<strong><?php translate("redirection_to_target")?></strong> <br /> <select
			name="redirect_on_404_to">
<?php foreach ($pages as $page) {?>
<option value="<?php Template::escape($page[1]);?>"
				<?php if ($redirect_on_404_to == $page[1]) {
        echo "selected";
    }?>><?php Template::escape($page[0]);?></option>
<?php } ?>
</select>
	</p>
	<input type="submit" value="<?php translate("save_changes"); ?>"
		name="submit">
</form>
<?php
}

?>