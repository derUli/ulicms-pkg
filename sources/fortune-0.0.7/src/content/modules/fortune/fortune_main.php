<?php
include_once getModulePath("fortune", true) . "fortune_lib.php";

function fortune_render()
{
    return Template::executeModuleTemplate("fortune", "default");
}
?>