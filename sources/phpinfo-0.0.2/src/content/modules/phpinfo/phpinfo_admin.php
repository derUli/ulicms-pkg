<?php
define ( "MODULE_ADMIN_HEADLINE", "Informationen zur Konfiguration von PHP" );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "phpinfo" );
function phpinfo_admin() {
	include_once getModulePath ( "phpinfo" ) . "phpinfo_main.php";
	echo phpinfo_render ();
}

?>
