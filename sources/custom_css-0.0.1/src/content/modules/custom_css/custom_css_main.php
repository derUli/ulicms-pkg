<?php
function custom_css__render() {
	$css = getconfig ( "custom_css" );
	$html = "<style type=\"text/css\">
" . $css . "
</style>
";
	return $html;
}
