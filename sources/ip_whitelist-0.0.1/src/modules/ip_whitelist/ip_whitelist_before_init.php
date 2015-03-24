<?php
function isIPAllowed($ip){
     $ip_whitelist = getconfig("ip_whitelist");
     if(!$ip_whitelist or empty($ip_whitelist))
         return true;
    
     $ip_whitelist = str_replace("\r\n", "\n", $ip_whitelist);
     $ip_whitelist = explode("\n", $ip_whitelist);
    
     for($i = 0; $i < count($ip_whitelist); $i++){
         $ip_whitelist[$i] = trim($ip_whitelist[$i], " ");
         if(endsWith($ip_whitelist[$i], ".")){
             if(startsWith($ip, $ip_whitelist[$i]))
                 return true;
             }else if($ip == $ip_whitelist[$i]){
             return true;
             }
         }
    
     return false;
    
     }
     
if(function_exists("get_ip")) 
   $ip = get_ip();
else
   $ip = $_SERVER['REMOTE_ADDR'];

if(is_admin_dir() and !isIPAllowed($ip)){
     header('HTTP/1.0 403 Forbidden');
     $translation = get_translation("access_from_this_ip_not_allowed");
     header("Content-Type: text/html; charset=UTF-8");
     if(!$translation)
        $translation = "Access to UliCMS Backend is not allowed from your IP (%ip%).";
     $translation = str_replace("%ip%", $ip, $translation);
     
     die($translation);
     }
