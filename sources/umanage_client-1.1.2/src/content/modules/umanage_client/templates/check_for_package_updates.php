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
                                                       value="<?php Template::escape($site["id"]); ?>/<?php Template::escape($package); ?>"
                                                       checked></td>
                                            <td><?php Template::escape($site["domain"]); ?></td>
                                            <td><?php Template::escape($package); ?></td>
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
        <?php } ?>

        <?php
    }
} else {
    noperms();
}
?>
<p>
    <a href="index.php?action=umanage_list"><?php translate("back") ?></a>
</p>
<script type="text/javascript"
src="<?php echo getModulePath("umanage_client") ?>scripts/packages.js"></script>
