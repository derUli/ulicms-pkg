
<?php
$id = intval ( $_GET ["id"] );
if ($id > 0) {
	$site = Sites::getSiteByID ($id);
	if ($site and Database::getNumRows ( $site ) > 0) {
		$site = Database::fetchAssoc ( $site );
		?>
<h1><?php translate("add_site");?></h1>
<form action="index.php?action=module_settings&module=umanage_client"
	method="post">
<?php csrf_token_html();?>
	<strong><?php translate("protocol")?></strong> <br /> <select
		name="protocol">
		<option value="http://"
			<?php if($site["protocol"] == "http://") echo "selected";?>>http://</option>
		<option value="https://"
			<?php if($site["protocol"] == "https://") echo "selected";?>>https://</option>
	</select> <br /> <br /> <strong><?php translate("domain");?></strong><br />
	<input type="text" name="domain"
		value="<?php Template::escape($site["domain"]);?>" maxlength="255"
		required> <br /> <br /> <strong><?php translate("path");?></strong><br />
	<input type="text" name="path"
		value="<?php Template::escape($site["path"]);?>" maxlength="255"
		required> <br /> <br /> <strong><?php translate("u_api_key");?></strong><br />
	<input type="text" name="api_key"
		value="<?php Template::escape($site["api_key"]);?>" maxlength="255"
		required> <br /> <br /> <input type="submit"
		value="<?php translate("save");?>"> <input type="hidden"
		name="form_action" value="edit_site"> <input type="hidden" name="id"
		value="<?php Template::escape($site["id"]);?>">
</form>
<?php
	}
}