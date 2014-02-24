<?php
$blocked_ips = file_get_contents(getModulePath("block_ips")."bannedips.csv");


$blocked_ips = str_replace(" ", "", $blocked_ips);

$blocked_ips = str_replace(",", "\n", $blocked_ips);

$blocked_ips = trim($blocked_ips);

if(!getconfig("blocked_ips"))
     setconfig("blocked_ips", $blocked_ips);

