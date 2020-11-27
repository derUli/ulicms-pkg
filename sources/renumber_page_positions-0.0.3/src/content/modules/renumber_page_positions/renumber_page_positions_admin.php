<?php
define("MODULE_ADMIN_HEADLINE", "Seitenpositionen neu organisieren");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "renumber_page_positions");

function renumber_page_positions_admin()
{
    if (isset($_POST["submit"])) {
        include_once getModulePath("renumber_page_positions", true) . "renumber_page_positions_lib.php";
        renumber_page_positions();
        echo "<p style='color:green'>Die Seitenpositionen wurden neu organisiert.</p>";
    } ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html(); ?>
<p>Falls Sie eine neue Seite erstellen möchten, aber Sie keinen Abstand
		zwischen den Positionen gelassen haben, können Sie diese Funktion
		nutzen, um die Positionsnummern der Seiten neu zu organisieren.</p>
	<input type="submit" name="submit"
		value="Seitenenpositionen neu organisieren" />
</form>
<?php
}

?>
