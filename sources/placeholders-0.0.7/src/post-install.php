<?php
echo "<p>";
echo "Datenbankstruktur anlegen... ";
flush();
db_query("CREATE TABLE IF NOT EXISTS `" . tbname("placeholders") . "` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` text NOT NULL,
  `match_case` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;");

echo "<span style='color:green'>[Fertig]</span>";
echo "</p>";
flush();
