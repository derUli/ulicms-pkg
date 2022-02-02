<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    if (StringHelper::isNotNullOrWhitespace(Request::getVar("sites"))) {
        ?>
        <p>
            <a href="<?php echo ModuleHelper::buildActionUrl("umanage_list"); ?>" class="btn btn-default">
                <i class="fa fa-arrow-left"></i>
                <?php translate("back"); ?>
            </a>
        </p>
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
                    <?php esc($site["domain"]); ?> ✓</span>
                <?php
            } else {
                ?>
                <span style="color: red">
                    <?php esc($site["domain"]); ?> ×</span>
                    <?php
            } ?>

            <br />

            <?php
            fcflush();
        } ?>

        <?php if (is_array($_GET["sites"]) and count($_GET["sites"]) > 0) { ?>
            <br />
            <?php
        } ?>
        <?php
    }
} else {
    noperms();
}
