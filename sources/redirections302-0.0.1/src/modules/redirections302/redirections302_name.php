<?php
function redirections302_name(){
     $names = array();
     $names["de"] = "Temporäre Umleitungen";
     $names["en"] = "temporary redirections";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
