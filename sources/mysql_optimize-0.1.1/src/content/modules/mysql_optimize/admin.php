<?php
use function UliCMS\HTML\icon;
define("MODULE_ADMIN_HEADLINE", get_translation("OPTIMIZE_DATABASE"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "mysql_optimize");

function mysql_optimize_admin() {
    if (isset($_POST["submit"])) {
        $cfg = new config();
        db_optimize($cfg->db_database);
    }
    ?>

    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <?php
        csrf_token_html();
        ?>
        <button type="submit" name="submit" class="btn btn-success">
		<?php echo icon("fas fa-broom");?> <?php translate("OPTIMIZE_AND_UPDATE_DATABASE"); ?></button>
    </form>
    <?php
}
?>
