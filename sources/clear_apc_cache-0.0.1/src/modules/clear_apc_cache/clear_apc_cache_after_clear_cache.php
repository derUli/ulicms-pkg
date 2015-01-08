<?php
error_reporting(E_ALL);
$include_file = getModulePath("clear_apc_cache"). "/clear_apc_cache_main.php";
include_once $include_file;
clear_apc_cache_render();
