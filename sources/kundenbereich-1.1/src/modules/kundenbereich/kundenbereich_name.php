<?php
function kundenbereich_name(){
     $names = array();
     $names["de"] = "Kundenbereich";
     $names["en"] = "Customer Area";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
