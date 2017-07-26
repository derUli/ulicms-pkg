<?php
db_query ( "CREATE TABLE IF NOT EXISTS `" . tbname ( "referrer" ) . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;" );

if (getconfig ( "referrer_limit" ) === false)
	setconfig ( "referrer_limit", "10" );

?>