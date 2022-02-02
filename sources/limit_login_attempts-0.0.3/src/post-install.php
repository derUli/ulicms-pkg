<?php
db_query("CREATE TABLE IF NOT EXISTS `" . tbname("failed_logins") . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;");

setconfig("max_login_attempts", "5");
setconfig("ip_blocking_duration", "3");
