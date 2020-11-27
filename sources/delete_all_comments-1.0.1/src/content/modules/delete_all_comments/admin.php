<?php
define("MODULE_ADMIN_HEADLINE", get_translation("delete_all_comments"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "delete_all_comments");
function delete_all_comments_admin()
{
    if (isset($_POST ["submit"])) {
        db_query("TRUNCATE TABLE " . tbname("blog_comments"));
    } ?>
<?php

    if (isset($_POST ["submit"])) {
        ?>
<p><?php translate("all_comments_deleted"); ?></p>
<?php
    } ?>

<form id="cform" action="<?php echo getModuleAdminSelfPath()?>"
	method="post"
	data-question="<?php translate("ask_for_delete_comments"); ?>"
	onsubmit="return deleteAllCommentsSubmit();">
<?php
    
    csrf_token_html(); ?>
<input type="submit" name="submit"
		value="<?php translate("delete_all_comments"); ?>" />
</form>
<script type="text/javascript"
	src="<?php echo getModulePath("delete_all_comments"); ?>js/admin.min.js"></script>
<?php
}

?>
