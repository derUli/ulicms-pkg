<?php
$acl = new ACL();
if ($acl->hasPermission("umanage_client")) {
    ?>
    <?php
    $id = intval($_GET["id"]);
    if ($id > 0) {
        $site = Sites::getSiteByID($id);
        if ($site and Database::getNumRows($site) > 0) {
            $site = Database::fetchAssoc($site);
            ?>    <p>
                <a href="<?php echo ModuleHelper::buildActionUrl("umanage_list"); ?>" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i>
                    <?php translate("back"); ?>
                </a>
            </p>
            <h1><?php translate("add_site"); ?></h1>
            <form action="index.php?action=module_settings&module=umanage_client"
                  method="post">
                      <?php csrf_token_html(); ?>
                <strong><?php translate("protocol") ?></strong> <br /> <select
                    name="protocol">
                    <option value="http://"
                            <?php if ($site["protocol"] == "http://") echo "selected"; ?>>http://</option>
                    <option value="https://"
                            <?php if ($site["protocol"] == "https://") echo "selected"; ?>>https://</option>
                </select> <br /> <br /> <strong><?php translate("domain"); ?></strong><br />
                <input type="text" name="domain"
                       value="<?php esc($site["domain"]); ?>" maxlength="255"
                       required>
                <br />
                <strong><?php translate("path"); ?></strong><br />
                <input type="text" name="path"
                       value="<?php esc($site["path"]); ?>" maxlength="255"
                       required>
                <br />
                <strong><?php translate("u_api_key"); ?></strong><br />
                <input type="text" name="api_key"
                       value="<?php esc($site["api_key"]); ?>" maxlength="255"
                       required>
                <br />
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    <?php translate("save"); ?>
                </button>´
                <input type="hidden"
                       name="form_action" value="edit_site"> <input type="hidden" name="id"
                       value="<?php esc($site["id"]); ?>">
            </form>
            <?php
        }
    }
} else {
    noperms();
}