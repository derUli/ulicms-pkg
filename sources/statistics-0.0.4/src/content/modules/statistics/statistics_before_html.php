<?php
if (! logged_in () and ! is_admin_dir () and ! is_crawler ()) {
	
	$heute = mktime ( 0, 0, 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
	
	$visitorHash = md5 ( $_SERVER ["REMOTE_ADDR"] . $_SERVER ["HTTP_USER_AGENT"] );
	
	$query = db_query ( "SELECT id FROM " . tbname ( "statistics" ) . " WHERE hash='$visitorHash' AND `date` >= $heute" );
	
	if (db_num_rows ( $query ) > 0) {
		db_query ( "UPDATE " . tbname ( "statistics" ) . " SET `date` = " . time () . ", `views` = `views` + 1 WHERE hash ='$visitorHash' AND `date` >= $heute" );
	} else {
		db_query ( "INSERT INTO " . tbname ( "statistics" ) . " (hash, date, `views`) VALUES ('$visitorHash',
     " . time () . ", 1)" );
	}
}

?>