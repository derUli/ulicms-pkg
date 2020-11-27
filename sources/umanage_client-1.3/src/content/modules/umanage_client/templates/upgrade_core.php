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
        <h1><?php translate("upgrade_core"); ?></h1>
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
                    <?php esc($site["domain"]); ?> ✓</span>
                <?php
            } else {
                ?>
                <span style="color: red">
                    <?php esc($site["domain"]); ?> × (<?php secure_translate($result); ?>)</span>
                    <?php
            }
            fcflush(); ?>

            <br />

            <?php
        } ?>

        <?php
        if (is_array($_GET["sites"]) and
                count($_GET["sites"]) > 0) {
            ?>
            <br />
            <?php
        } ?>
        <?php
    }
} else {
    noperms();
}
