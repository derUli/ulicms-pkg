<?php
function isIPBlocked($ip){
     $blocked_ips = getconfig("blocked_ips");
     if(!$blocked_ips)
         return false;
    
     if(empty($blocked_ips))
         return false;
    
     $blocked_ips = str_replace("\r\n", "\n", $blocked_ips);
     $blocked_ips = explode("\n", $blocked_ips);
    
     for($i = 0; $i < count($blocked_ips); $i++){
         if(endsWith($blocked_ips[$i], ".")){
             if(startsWith($ip, $blocked_ips[$i]))
                 return true;
             }else if($ip == $blocked_ips[$i]){
             return true;
             }
         }
    
     return false;
    
     }

$ip = $_SERVER['REMOTE_ADDR'];

if(isIPBlocked($ip)){
     header('HTTP/1.0 403 Forbidden');
     die("Der Zugriff von Ihrer IP-Adresse ($ip) wurde gesperrt!");
     }
