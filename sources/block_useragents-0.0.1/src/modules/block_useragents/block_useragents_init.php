<?php
function isUserAgentBlocked($ua){
     $blocked_useragents = getconfig("blocked_useragents");
     if(!$blocked_useragents)
         return false;
    
     if(empty($blocked_useragents))
         return false;
    
     $blocked_useragents = str_replace("\r\n", "\n", $blocked_useragents);
     $blocked_useragents = explode("\n", $blocked_useragents);
    
     for($i = 0; $i < count($blocked_useragents); $i++){

             if(trim($ua) == trim($blocked_useragents[$i])){
                return true;
           }
         }
    
     return false;
    
     }

$ua = $_SERVER['HTTP_USER_AGENT'];

if(isUserAgentBlocked($ua)){
     header('HTTP/1.0 403 Forbidden');
     die("Der Zugriff mit Ihrem User-Agent ($ua) wurde gesperrt!");
}