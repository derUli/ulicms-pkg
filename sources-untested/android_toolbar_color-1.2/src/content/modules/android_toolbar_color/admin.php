<?php
define("MODULE_ADMIN_HEADLINE", get_translation("android_toolbar_color"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "android_toolbar_color");

function android_toolbar_color_admin() {
    if (isset($_POST["android_toolbar_color"])) {
        Settings::set("android_toolbar_color", $_POST["android_toolbar_color"]);
    }
    ?>
    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <p>
            <strong><?php translate("android_toolbar_color"); ?></strong><br /> <input
                name="android_toolbar_color" class="jscolor {
                    hash:true,caps:true
                }"
                value="<?php esc(Settings::get("android_toolbar_color")); ?>">
        </p>
        <p>
            <button type="submit" class="btn btn-success"><?php translate("save_changes"); ?></button>
        </p>
        <?php csrf_token_html(); ?>
    </form>
    <?php
}
?>
