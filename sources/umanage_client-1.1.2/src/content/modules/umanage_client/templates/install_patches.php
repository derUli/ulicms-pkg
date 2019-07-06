<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    if (StringHelper::isNotNullOrWhitespace(Request::getVar("sites"))) {
        ?>
        <h1><?php translate("clear_log"); ?></h1>
        <?php
        foreach ($_POST["patches"] as $p) {
            $splitted = explode("/", $p);
            $sid = $splitted[0];
            $patchName = $splitted[1];

            $sid = intval($sid);
            $site = Sites::getSiteByID($sid);
            $site = Database::fetchAssoc($site);
            $con = new uManageConnection($site["api_key"], $site["url"]);
            $result = $con->installPatches(array(
                $patchName
            ));
            if ($result and isset($result["ok"]) and count($result["ok"]) > 0) {
                ?>
                <span style="color: green">
                    <?php Template::escape($patchName); ?> =&gt; <?php Template::escape($site["domain"]); ?> ✓</span>
                <?php
            } else {
                ?>
                <span style="color: red">
                    <?php Template::escape($patchName); ?> =&gt; <?php Template::escape($site["domain"]); ?> ×</span>
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
    <a href="index.php?action=umanage_list"><?php translate("back") ?></a>
</p>