<?php
$migrator = new DBMigrator(
    "module/faq",
    ModuleHelper::buildModuleRessourcePath("faq", "sql/up")
);
$migrator->migrate();
?>
<p>
	Bitte beachten Sie, dass Sie noch Ihr Stylesheet für die FAQ-Seite
	anpassen müssen.<br /> <br /> Sie können die Datei <a
		href="scripts/vallenato/vallenato.css" target="_blank">scripts/vallenato/vallenato.css</a>
	als Vorlage nehmen
</p>
</p>