<?php
Database::query("CREATE TABLE IF NOT EXISTS `{prefix}device_infos` (
  `mobile` mediumint(9) NOT NULL DEFAULT '0',
  `tablet` mediumint(9) NOT NULL DEFAULT '0',
  `crawler` mediumint(9) NOT NULL DEFAULT '0',
  `pc` mediumint(9) NOT NULL DEFAULT '0',
  `ajax` mediumint(9) not null default '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", true);

$query = Database::query("select * from {prefix}device_infos", true);
if (Database::getNumRows($query) <= 0) {
    Database::query("insert into `{prefix}device_infos` (mobile, tablet, crawler, pc) values (0, 0, 0, 0 )", true);
}
