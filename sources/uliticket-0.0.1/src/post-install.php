$sql1 = "CREATE TABLE IF NOT EXISTS `".tbname("tickets")."` (
`id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  `updated` bigint(20) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$sql2 = "CREATE TABLE IF NOT EXISTS `".tbname("ticket_replies")."` (
`id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  `updated` bigint(20) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

$sql3 = "CREATE TABLE IF NOT EXISTS `".tbname("ticket_status_types")."` (
`id` int(11) NOT NULL,
`name` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;";

$sql4 = "SELECT count(name) as amount from ".tbname("ticket_status_types");

$sql5 = "INSERT INTO `".tbname("ticket_status_types").` (`id`, `name`) VALUES
(1, 'Offen'),
(2, 'In Bearbeitung'),
(3, 'Gelöst');";

db_query($sql1);
db_query($sql2);
db_query($sql3);

$count = db_query($sql4);
$result = db_fetch_object($count);
if($result["amount"] <= 0)
   db_query($sql4);
