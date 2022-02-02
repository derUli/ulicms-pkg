<?php

function twitter_for_php_render()
{
    if (! class_exists("Twitter")) {
        include_once getModulePath("twitter_for_php", true) . "twitter.class.php";
    }
    return "";
}
