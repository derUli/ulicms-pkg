<h1><?php translate("upgrade_core");?></h1>
<?php
foreach (explode(",", $_REQUEST["sites"]) as $id) {
    $nid = intval($id);
    $site = Sites::getSiteByID($nid);
    $site = Database::fetchAssoc($site);
    $con = new uManageConnection($site["api_key"], $site["url"]);
    $result = $con->upgradeCore();
    if ($result === true) {
        ?>
<span style="color: green">
		<?php Template::escape($site["domain"]);?> ✓</span>
<?php
    } else {
        ?>
<span style="color: red">
		<?php Template::escape($site["domain"]);?> × (<?php secure_translate($result);?>)</span>
<?php
    }
    fcflush();
    ?>

<br />

<?php
}
?>
	
	<?php if(count($_GET["sites"]) > 0){?>
<br />
<?php
}
?>
<a href="#" onclick="history.back();"><?php translate("back")?></a>