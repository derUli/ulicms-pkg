<?php
if (containsModule ( get_slug (), "jquery_tablesorter" )) {
	
	$theme = getconfig ( "jquery_tablesorter_theme" );
	if (! $theme)
		$theme1 = "blue";
	
	$theme = basename ( $theme );
	?>
<script type="text/javascript"
	src="<?php
	
echo getModulePath ( "jquery_tablesorter" );
	?>jquery.tablesorter.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="<?php
	
echo getModulePath ( "jquery_tablesorter" );
	?>themes/<?php
	
echo $theme;
	?>/style.css" />
<?php

}
?>
