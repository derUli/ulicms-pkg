<?php
if (! getconfig ( "custom_css" )) {
	$default = "/* Insert your css codes here */
";
	setconfig ( "custom_css", db_escape ( $default ) );
}

?>
