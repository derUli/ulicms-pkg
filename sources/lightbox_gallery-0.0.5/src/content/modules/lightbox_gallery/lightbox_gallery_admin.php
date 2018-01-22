<?php
define("MODULE_ADMIN_HEADLINE", "Lightbox Bildergalerie");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "gallery_settings");

if (! empty($_POST["image_gallery_images_per_row"])) {
    setconfig("image_gallery_images_per_row", intval($_POST["image_gallery_images_per_row"]));
}

function lightbox_gallery_admin()
{
    ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html();
    ?>
<input type="number" name="image_gallery_images_per_row" min="1" max="5"
		value="<?php
    echo getconfig("image_gallery_images_per_row");
    ?>" /> <strong>Bilder pro Zeile anzeigen</strong> <br /> <br />

	<button type="submit" class="btn btn-success">Einstellungen speichern</button>
</form>
<?php
}

?>
