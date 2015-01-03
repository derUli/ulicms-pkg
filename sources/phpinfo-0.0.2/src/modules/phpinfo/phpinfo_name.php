<?php
function phpinfo_name(){
     $names = array();
     $names["de"] = "Serverinformationen anzeigen";
     $names["en"] = "Show server informations";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
    }
