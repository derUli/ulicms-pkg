<?php
function phpContact_render() {
	// disable Anti CSRF Token check, since we are not able to add such a token to the contact form
	no_anti_csrf ();
	$file = ULICMS_ROOT . "/phpContact/index.php";
	$retval = "<span class=\"ulicms_error\">Bitte installieren Sie zuerst phpContact nach " . $file . ".</span>";
	if (is_file ( $file )) {
		ob_start ();
		include_once $file;
		$retval = ob_get_clean ();
	}
	return $retval;
}
