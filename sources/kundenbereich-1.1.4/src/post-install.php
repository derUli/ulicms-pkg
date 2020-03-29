<?php
$create_shared_files_table = "CREATE TABLE IF NOT EXISTS `" . tbname ( "shared_files" ) . "` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;";

db_query ( $create_shared_files_table );
