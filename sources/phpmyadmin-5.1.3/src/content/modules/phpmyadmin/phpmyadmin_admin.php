<?php
define("MODULE_ADMIN_HEADLINE", get_translation("phpmyadmin"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "phpmyadmin");

function phpmyadmin_admin() {
    ?>
    <p>
        <a href="<?php echo getModulePath("phpmyadmin") . "phpmyadmin/" ?>" id="phpmyadmin-link"
           target="_blank">[<?php translate("open_phpmyadmin"); ?>]</a>
    </p>
    <?php
    enqueueScriptFile(ModuleHelper::buildRessourcePath("phpmyadmin", "js/main.js"));
    combinedScriptHtml();
}
