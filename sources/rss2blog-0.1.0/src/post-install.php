<?php
@mkdir ( getModulePath ( "rss2blog" ) . "etc/", $recursive = true );
if (! is_file ( getModulePath ( "rss2blog" ) . "etc/" . "sources.ini" )) {
	file_put_contents ( getModulePath ( "rss2blog" ) . "etc/sources.ini", "# Hier die URLs zu den RSS-Quellen eintragen.\r\n" );
}

Settings::Register( "rss2blog_bot_user_id", "1" );

$migrator = new DBMigrator("module/rss2blog", ModuleHelper::buildModuleRessourcePath("rss2blog", "sql/up"));
$migrator->migrate();