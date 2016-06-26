<?php
if (! function_exists ( "crawlerDetect" )) {
	function crawlerDetect() {
		if (isset ( $_SERVER ['HTTP_USER_AGENT'] ) && preg_match ( '/bot|crawl|slurp|spider/i', $_SERVER ['HTTP_USER_AGENT'] )) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

$referer = $_SERVER ['HTTP_REFERER'];

$domain = $_SERVER ['HTTP_HOST'];

$referer_contains_domain = strpos ( $referer, $domain ) !== false;

if (! is_admin_dir () and ! crawlerDetect () and ! empty ( $referer ) and ! logged_in () and ! $referer_contains_domain) {
	
	$url = db_escape ( $referer );
	
	$query = db_query ( "SELECT * FROM " . tbname ( "referrer" ) . " WHERE `url` = '$url'" );
	
	if (db_num_rows ( $query ) > 0 and ! empty ( $url )) {
		db_query ( "UPDATE " . tbname ( "referrer" ) . " SET `amount` = `amount` + 1 WHERE `url` = '$url'" );
	} else if (! empty ( $url )) {
		db_query ( "INSERT INTO " . tbname ( "referrer" ) . " (`url`, `amount`) VALUES ('$referer', 1)" );
	}
}

?>