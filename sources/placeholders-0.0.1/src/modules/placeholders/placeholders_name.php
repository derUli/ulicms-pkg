<?php
function placeholders_name(){
     $names = array();
     $names["de"] = "Platzhalter";
     $names["en"] = "Placeholders";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
