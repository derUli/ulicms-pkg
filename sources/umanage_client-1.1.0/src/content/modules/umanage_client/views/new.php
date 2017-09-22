<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    ?>
<h1><?php translate("add_site");?></h1>
<form action="index.php?action=module_settings&module=umanage_client"
	method="post">
<?php csrf_token_html();?>
	<strong><?php translate("protocol")?></strong> <br /> <select
		name="protocol">
		<option value="http://">http://</option>
		<option value="https://">https://</option>
	</select> <br /> <br /> <strong><?php translate("domain");?></strong><br />
	<input type="text" name="domain" value="" maxlength="255" required> <br />
	<br /> <strong><?php translate("path");?></strong><br /> <input
		type="text" name="path" value="/" maxlength="255" required> <br /> <br />
	<strong><?php translate("u_api_key");?></strong><br /> <input
		type="text" name="api_key" value="" maxlength="255" required> <br /> <br />
	<input type="submit" value="<?php translate("save");?>"> <input
		type="hidden" name="form_action" value="create_site">
</form>

<?php
} else {
    noperms();
}
?>