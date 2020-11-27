<?php
define("MODULE_ADMIN_HEADLINE", "Anti-Virus");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "phpAntiVirus");

function phpAntiVirus_admin()
{
    ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html(); ?>
<input type="submit" name="submit" value="Scan durchführen" />
</form>
<?php
    if (isset($_POST["submit"])) {
        include_once getModulePath("phpAntiVirus", true) . "index.php";
    }
}

?>
