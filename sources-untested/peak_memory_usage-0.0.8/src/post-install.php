<?php

Database::query("CREATE TABLE IF NOT EXISTS `" . tbname("peak_memory_usage") . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peak_memory_usage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;");
