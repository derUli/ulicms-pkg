<?php
function custom_admin_css__render()
{
    $css = getconfig("custom_admin_css");
    $html = "<style type=\"text/css\">
" . $css . "
</style>
";
    return $html;
}
