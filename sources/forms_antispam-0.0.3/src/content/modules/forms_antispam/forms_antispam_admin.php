<?php
define("MODULE_ADMIN_HEADLINE", get_translation("forms_antispam_settings"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "forms_antispam_settings");

function forms_antispam_admin() {
    if (isset($_POST ["submit"])) {
        Settings::set("antispam_field_name", $_POST ["antispam_field_name"]);
    }

    $antispam_field_name = getconfig("antispam_field_name");
    if (!$antispam_field_name) {
        $antispam_field_name = "";
    }
    ?>
    <form action="<?php echo getModuleAdminSelfPath(); ?>" method="post">
        <?php csrf_token_html(); ?>
        <p>
            <strong><?php translate("antispam_field_name"); ?>:</strong> <input
                name="antispam_field_name" type="text"
                value="<?php echo htmlspecialchars($antispam_field_name); ?>">
        </p>
        <p>
            <input type="submit" name="submit" value="<?php translate("save"); ?>" />
        </p>
    </form>
    <?php
}
