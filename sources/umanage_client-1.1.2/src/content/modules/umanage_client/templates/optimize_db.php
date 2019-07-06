<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    if (StringHelper::isNotNullOrWhitespace(Request::getVar("sites"))) {
        ?>
        <h1><?php translate("optimize_database"); ?></h1>
        <?php
        foreach (explode(",", $_REQUEST["sites"]) as $id) {
            $nid = intval($id);
            $site = Sites::getSiteByID($nid);
            $site = Database::fetchAssoc($site);
            $con = new uManageConnection($site["api_key"], $site["url"]);
            $result = $con->optimizeDB();
            if ($result and isset($result["result"]) and $result["result"] == "ok") {
                ?>
                <span style="color: green">
                    <?php Template::escape($site["domain"]); ?> ✓</span>
                <?php
            } else {
                ?>
                <span style="color: red">
                    <?php Template::escape($site["domain"]); ?> ×</span>
                    <?php
                }
                ?>

            <br />

            <?php
            fcflush();
        }
        ?>

        <?php if (count($_GET["sites"]) > 0) { ?>
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
<p>
    <a href="#" onclick="history.back();"><?php translate("back") ?></a>
</p>