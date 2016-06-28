<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "common_useragents" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "useragents" );
function useragents_admin() {
	$useragents_limit = getconfig ( "useragents_limit" );
	
	if ($useragents_limit === false)
		$useragents_limit = 10;
	
	$data = db_query ( "SELECT * FROM " . tbname ( "useragents" ) . " ORDER by `amount` DESC LIMIT $useragents_limit" );
	
	if (db_num_rows ( $data ) > 0) {
		echo "<table>";
		while ( $row = db_fetch_object ( $data ) ) {
			echo "<tr>";
			echo "<td style=\"font-weight:bold; min-width:100px;\">" . htmlspecialchars ( $row->useragent, ENT_QUOTES, "UTF-8" ) . "</td>";
			echo "<td style=\"text-align:right; min-width:100px;\">" . intval ( $row->amount ) . "</td>";
			echo "</tr>";
		}
		
		echo "</table>";
	} else {
		echo "<p>" . get_translation ( "no_data" ) . "</p>";
	}
}
