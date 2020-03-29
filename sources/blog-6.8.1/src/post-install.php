<?php
$migrator = new DBMigrator("module/blog", ModuleHelper::buildModuleRessourcePath("blog", "sql/up"));
$migrator->migrate();