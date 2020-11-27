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
                    <?php esc($patchName); ?> =&gt; <?php esc($site["domain"]); ?> ✓</span>
                <?php
            } else {
                ?>
                <span style="color: red">
                    <?php esc($patchName); ?> =&gt; <?php esc($site["domain"]); ?> ×</span>
                    <?php
            } ?>

            <br />

            <?php
            fcflush();
        } ?>

        <?php if (count($_GET["sites"]) > 0) { ?>
            <br />
            <?php
        } ?>
        <?php
    }
} else {
    noperms();
}
