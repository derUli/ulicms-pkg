<?php
$create_shared_files_table = "CREATE TABLE IF NOT EXISTS `".tbname("shared_files")."` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

db_query($create_shared_files_table);

$add_primary_key = "ALTER TABLE `".tbname("shared_files")."` ADD PRIMARY KEY (`id`);";
 db_query($add_primary_key);