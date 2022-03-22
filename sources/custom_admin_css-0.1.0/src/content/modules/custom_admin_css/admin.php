<?php
define("MODULE_ADMIN_HEADLINE", get_translation("custom_admin_css_title"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "custom_admin_css");

function custom_admin_css_admin() {
    if (isset($_POST["submit"])) {
        Settings::set("custom_admin_css", $_POST["custom_admin_css"]);
    }

    $custom_admin_css = Settings::get("custom_admin_css");
    ?>

    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <?php csrf_token_html(); ?>
        <p>
            <?php translate("custom_admin_css_help") ?><br />
        </p>
        <p>
            <textarea rows="30" cols="80" style="width: 100%"
                      name="custom_admin_css" class="codemirror" data-mimetype="text/css"><?php esc($custom_admin_css); ?></textarea>


        <p>
            <input type="submit" name="submit"
                   value="<?php translate("save_changes"); ?>" />
        </p>
    </form>
    <?php
    BackendHelper::enqueueEditorScripts();
    combinedScriptHtml();
}
?>