<?php

$css = getconfig("custom_admin_css");
$css = StringHelper::trimLines($css);
$html = "<style type=\"text/css\">
" . $css . "
</style>
";
echo $html;
