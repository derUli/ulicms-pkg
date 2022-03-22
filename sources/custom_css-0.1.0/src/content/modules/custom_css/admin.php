<?php
define("MODULE_ADMIN_HEADLINE", get_translation("custom_css_title"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "custom_css");

function custom_css_admin() {
    if (isset($_POST ["submit"])) {
        Settings::set("custom_css", $_POST ["custom_css"]);
    }

    $custom_css = Settings::get("custom_css");
    ?>

    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <?php csrf_token_html(); ?>
        <p>
            <?php translate("custom_css_help"); ?><br />
        </p>
        <p>
            <textarea rows="30" cols="80" style="width: 100%" name="custom_css" class="codemirror" data-mimetype="text/css"><?php esc($custom_css); ?></textarea>
        </p>

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
