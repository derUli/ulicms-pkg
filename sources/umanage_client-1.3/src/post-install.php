<?php

$migrator = new DBMigrator("module/umanage_client", ModuleHelper::buildModuleRessourcePath("umanage_client", "sql/up"));
$migrator->migrate();
