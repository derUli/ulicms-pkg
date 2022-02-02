<?php
$migrator = new DBMigrator("module/search_subjects", ModuleHelper::buildModuleRessourcePath("search_subjects", "sql/down"));
$migrator->rollback();

Settings::delete("search_subhjects_limit");
