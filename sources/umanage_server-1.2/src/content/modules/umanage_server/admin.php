<?php
define("MODULE_ADMIN_HEADLINE", "uManage Server");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "umanage_server");

function umanage_server_admin()
{
    ?>

    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <strong><?php translate("umanage_api_key"); ?></strong><br /> <input
            type="text" readonly="readonly"
            value="<?php Template::escape(Settings::get("umanage_api_key")); ?>"
            onclick="this.select()">
    </form>
    <?php
}
