<?php
db_query("CREATE TABLE IF NOT EXISTS `" . tbname("useragents") . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

if(getconfig("useragents_limit") === false)
     setconfig("useragents_limit", "10");

?>