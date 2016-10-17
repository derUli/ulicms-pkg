<?php
if (! getconfig ( "custom_admin_css" )) {
	$default = "/* Insert your css codes here */
";
	setconfig ( "custom_admin_css", db_escape ( $default ) );
}

?>
