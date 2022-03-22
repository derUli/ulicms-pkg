<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    if (StringHelper::isNotNullOrWhitespace(Request::getVar("sites"))) {
        $data_here = false;
        foreach (explode(",", $_REQUEST["sites"]) as $id) {
            $nid = intval($id);
            $site = Sites::getSiteByID($nid);
            $site = Database::fetchAssoc($site);
            $con = new uManageConnection($site["api_key"], $site["url"]);
            $result = $con->checkForPackageUpdates();
            if ($result and count($result["packages"]) > 0) {
                $data_here = true;
                break;
            }
        }
        ?>
        <p>
            <a href="<?php echo ModuleHelper::buildActionUrl("umanage_list"); ?>" class="btn btn-default">
                <i class="fa fa-arrow-left"></i>
                <?php translate("back"); ?>
            </a>
        </p>
        <h1><?php translate("CHECK_FOR_PACKAGE_UPDATES"); ?></h1>
        <?php if ($data_here) { ?>
            <form action="index.php?action=umanage_install_packages" method="post"
                  id="package-list-form">
                      <?php csrf_token_html(); ?>
                <p>
                    <input id="checkall" type="checkbox" class="checkall" checked> <label
                        for="checkall"><?php
                            translate("select_all");
                            ?> </label>
                </p>
                <div class="scroll">
                    <table class="tablesorter">
                        <thead>
                            <tr>
                                <td></td>
                                <th><?php translate("domain"); ?></th>
                                <th><?php translate("package"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (explode(",", $_REQUEST["sites"]) as $id) {
                                $nid = intval($id);
                                $site = Sites::getSiteByID($nid);
                                $site = Database::fetchAssoc($site);
                                $con = new uManageConnection($site["api_key"], $site["url"]);
                                $result = $con->checkForPackageUpdates();
                                if ($result and isset($result["packages"])) {
                                    $packages = $result["packages"];
                                    ?>
                                    <?php foreach ($packages as $package) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="packages[]"
                                                       class="package-checkbox"
                                                       value="<?php esc($site["id"]); ?>/<?php esc($package); ?>"
                                                       checked></td>
                                            <td><?php esc($site["domain"]); ?></td>
                                            <td><?php esc($package); ?></td>
                                        </tr>
                                        <?php
                                        fcflush();
                                    }
                                    ?>
                                    <?php
                                }
                                fcflush();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <p>
                    <input type="submit" value="<?php translate("install_updates"); ?>">
                </p>
            </form>
            <?php
        } else {
            ?>
            <p><?php translate("NO_UPDATES_AVAILABLE"); ?></p>
        <?php }
        ?>

        <?php
    }
} else {
    noperms();
}
?>
<script type="text/javascript"
src="<?php echo getModulePath("umanage_client") ?>scripts/packages.js"></script>


