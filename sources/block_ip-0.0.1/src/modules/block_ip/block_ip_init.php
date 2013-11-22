<?php 
function isIPBlocked($ip){
    $blocked_ips = getconfig("blocked_ips");
    if(!$blocked_ips)
       return false;
       
     if(empty($blocked_ips))
        return false;

     $blocked_ips = str_replace("\r\n", "\n", $blocked_ips);
     
    
    }
