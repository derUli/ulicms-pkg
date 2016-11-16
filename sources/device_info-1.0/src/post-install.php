<?php
Database::query("CREATE TABLE IF NOT EXISTS `{prefix}device_infos` (
  `mobile` mediumint(9) NOT NULL DEFAULT '0',
  `tablet` mediumint(9) NOT NULL DEFAULT '0',
  `crawler` mediumint(9) NOT NULL DEFAULT '0',
  `pc` mediumint(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ut8;", true);
