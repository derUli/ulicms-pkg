<?php

function blog2twitter_render()
{
    include_once getModulePath("blog2twitter", true) . "blog2twitter_cron.php";
    return "";
}
?>