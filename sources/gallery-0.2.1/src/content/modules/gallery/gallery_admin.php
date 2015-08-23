<?php
define("MODULE_ADMIN_HEADLINE", "Einstellungen der einfachen Bildergalerie");
$required_permission = "gallery_settings";
define("MODULE_ADMIN_REQUIRED_PERMISSION", $required_permission);

if(!empty($_POST["image_gallery_images_per_row"])){
     setconfig("image_gallery_images_per_row",
         intval($_POST["image_gallery_images_per_row"]));
     }

function gallery_admin(){
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();
    ?>
<input type="number" name="image_gallery_images_per_row" min="1" max="5" value="<?php
     echo getconfig("image_gallery_images_per_row");
     ?>"/> <strong>Bilder pro Zeile anzeigen</strong>
<br/>
<br/>

<input type="submit" value="Einstellungen speichern"/>
</form>
<?php
     }

?>