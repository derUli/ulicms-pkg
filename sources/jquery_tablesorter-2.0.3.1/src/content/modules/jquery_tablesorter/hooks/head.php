<?php
if (containsModule ( get_requested_pagename (), "jquery_tablesorter" )) {
	
	$theme = getconfig ( "jquery_tablesorter_theme" );
	if (! $theme)
		$theme1 = "blue";
	
	$theme = basename ( $theme );
	?>
<link rel="stylesheet" type="text/css"
	href="<?php
	
echo getModulePath ( "jquery_tablesorter" );
	?>themes/<?php
	
echo $theme;
	?>/style.css" />
<?php

}
?>
