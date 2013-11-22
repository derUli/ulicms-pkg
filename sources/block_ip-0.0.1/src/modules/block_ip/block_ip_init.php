<?php 
function isIPBlocked($ip){
    $blocked_ips = getconfig("blocked_ips");
    if(!$blocked_ips)
       return false;
       
     if(empty($blocked_ips))
        return false;

     $blocked_ips = str_replace("\r\n", "\n", $blocked_ips);
     $blocked_ips = explode("\n", $blocked_ips);
     
     for($i = 0; $ i < count($blocked_ips ); $i++){
        if(endsWith($blocked_ips[$i], ".")){
           if(startsWith($ip, $blocked_ips[$i]))
              return true;
        }
     }
     
     return false;
    
    }
