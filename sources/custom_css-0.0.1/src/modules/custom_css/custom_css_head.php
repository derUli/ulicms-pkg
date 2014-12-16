<?php
	$css = getconfig("custom_css");
	$html = "<style type=\"text/css\">
".$css."
</style>
";
	echo $html;