<?php
echo "<p>";
echo "Datenbankstruktur anlegen... ";
flush();
db_query("CREATE TABLE IF NOT EXISTS `".tbname("placeholders")."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

echo "<span style='color:green'>[Fertig]</span>";
echo "</p>";
flush();
