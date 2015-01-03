<?php
function redirections301_name(){
     $names = array();
     $names["de"] = "Permanente Umleitungen";
     $names["en"] = "permanent redirections";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
