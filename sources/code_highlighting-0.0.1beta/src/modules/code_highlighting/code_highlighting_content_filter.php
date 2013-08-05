﻿<?php

function get_mime($file){
     if (function_exists("finfo_file")){
         $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
         $mime = finfo_file($finfo, $file);
         finfo_close($finfo);
         return $mime;
         }else if (function_exists("mime_content_type")){
         return mime_content_type($file);
         }else if (!stristr(ini_get("disable_functions"), "shell_exec")){
         // http://stackoverflow.com/a/134930/1593459
        $file = escapeshellarg($file);
         $mime = shell_exec("file -bi " . $file);
         return $mime;
         }else{
         return false;
         }
     }


function code_highlighting_content_filter($html){
     // Wenn der Content keinen code-Tag enthält, abbrechen
    if(strpos($html, "[code src=") === false)
         return $html;
    
     $baseDir = "./content/files/";
     $allContentFiles = find_all_files($baseDir);
    
     // Durch den files-Ordner durchiterieren
    for($l = 0; $l < count($allContentFiles); $l++){
         $replaceName = str_replace($baseDir, "", $allContentFiles[$l]);
         $replaceName = str_replace("../", "", $replaceName);
         $replaceName = trim($replaceName, "/");
         $replaceName = html_entity_decode($replaceName, ENT_QUOTES, "UTF-8");
        
         // Zu ersetzender String mit kodierten Anführungszeichen und ohne
        $replaceString1 = "[code src=\"" . $replaceName . "\"]";
         $replaceString2 = "[code src=&quot;" . $replaceName . "&quot;]";
        
         $mime = get_mime($allContentFiles[$l]);
         $allowed_mime = array("text/php", "text/x-php", "text/plain", "application/php",
             "application/x-php", "application/x-httpd-php", "application/x-httpd-php-source",
             "text/html", "text/xml", "text/javascript", "application/json");
        
         if(in_array($mime, $allowed_mime)){
            
             // Code in String lesen
            $fileContent = highlight_file($allContentFiles[$l], true);
            
             // Platzhalter ersetzen
            $html = str_replace($replaceString1, $fileContent, $html);
             $html = str_replace($replaceString2, $fileContent, $html);
            
             }
         }
     return $html;
     }
?>