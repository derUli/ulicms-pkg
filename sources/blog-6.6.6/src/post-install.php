<?php
// Post Install Script für Blog Package 6.0.2
if (! function_exists("setconfig")) {
    include "init.php";
}

echo "<p>Lege Datenbankstruktur an</p>";
db_query("CREATE TABLE IF NOT EXISTS `" . tbname("blog") . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` bigint(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `seo_shortname` varchar(200) NOT NULL,
  `comments_enabled` tinyint(1) NOT NULL,
  `language` varchar(6) NOT NULL,
  `entry_enabled` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `content_full` longtext NOT NULL,
  `content_preview` longtext NOT NULL,
  `views` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;");

db_query("CREATE TABLE IF NOT EXISTS `" . tbname("blog_comments") . "` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(38) NOT NULL,
`email` varchar(255) NOT NULL,
`url` varchar(255) NOT NULL,
`comment` text NOT NULL,
`date` BIGINT NOT NULL,
`post_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;");

Database::query("ALTER TABLE `{prefix}blog` modify `content_full` mediumtext NOT NULL;", true);
Database::query("ALTER TABLE `{prefix}blog` modify `content_preview` mediumtext NOT NULL;", true);

db_query("ALTER TABLE `" . tbname("blog") . "` ADD `meta_description` VARCHAR(255) NULL, ADD `meta_keywords` VARCHAR(255) NULL");

echo "<p>fertig</p>";
