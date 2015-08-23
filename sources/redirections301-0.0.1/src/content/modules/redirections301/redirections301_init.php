<?php
 $redirections = getconfig("redirections301");
 if($redirections and !empty($redirections)){
     $redirections = str_replace("\r\n", "\n", $redirections);
     $redirections = explode("\n", $redirections);
    
     for($i = 0; $i < count($redirections); $i++){
         if(!startsWith($redirections[$i], "#")){
             $urls = explode("=>", $redirections[$i]);
             if(count($urls) >= 2){
                 $urls[0] = trim($urls[0]);
                 $urls[1] = trim($urls[1]);
                 if($urls[0] == $_SERVER["REQUEST_URI"]){
                     header("HTTP/1.1 301 Moved Permanently");
                     header("Location: " . $urls[1]);
                     exit();
                     }
                 }
            
            
             }
        
        
         }
    
    
    
    
     }

