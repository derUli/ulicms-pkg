<?php
$usage = memory_get_peak_usage();

$current = Settings::get("peak_memory_usage");
if(($current and $usage > $current)){
   Settings::set("peak_memory_usage", $usage);
} else if(!$current){
   Settings::set("peak_memory_usage", $usage);
}
