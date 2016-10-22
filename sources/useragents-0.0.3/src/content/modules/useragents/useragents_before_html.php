<?php
$useragent = $_SERVER ['HTTP_USER_AGENT'];

if (! is_admin_dir () and ! empty ( $useragent ) and ! logged_in ()) {
	
	$useragent = db_escape ( $useragent );
	
	$query = db_query ( "SELECT id FROM " . tbname ( "useragents" ) . " WHERE `useragent` = '$useragent'" );
	
	if (db_num_rows ( $query ) > 0 and ! empty ( $useragent )) {
		db_query ( "UPDATE " . tbname ( "useragents" ) . " SET `amount` = `amount` + 1 WHERE `useragent` = '$useragent'" );
	} else if (! empty ( $useragent )) {
		db_query ( "INSERT INTO " . tbname ( "useragents" ) . " (`useragent`, `amount`) VALUES ('$useragent', 1)" );
	}
}

?>