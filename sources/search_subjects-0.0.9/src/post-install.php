<?php

$migrator = new DBMigrator("module/search_subjects", ModuleHelper::buildModuleRessourcePath("search_subjects", "sql/up"));
$migrator->migrate();

Settings::register("search_subjects_limit", "10");
