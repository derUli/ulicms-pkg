<?php
$css = getconfig ( "custom_admin_css" );
$html = "<style type=\"text/css\">
" . $css . "
</style>
";
echo $html;
