<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    if (StringHelper::isNotNullOrWhitespace(Request::getVar("sites"))) {
        ?>
<h1><?php
        
        translate("clear_log");
        ?></h1>
<?php
        foreach (explode(",", $_REQUEST["sites"]) as $id) {
            $nid = intval($id);
            $site = Sites::getSiteByID($nid);
            $site = Database::fetchAssoc($site);
            $con = new uManageConnection($site["api_key"], $site["url"]);
            $result = $con->clearLog();
            if ($result and isset($result["result"])) {
                ?>
<span style="color: green">
		<?php Template::escape($site["domain"]);?> ✓</span>
<?php
            } else {
                ?>
<span style="color: red">
		<?php Template::escape($site["domain"]);?> ×</span>
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
	<?php
    }
} else {
    noperms();
}
?>
<a href="#" onclick="history.back();"><?php translate("back")?></a>