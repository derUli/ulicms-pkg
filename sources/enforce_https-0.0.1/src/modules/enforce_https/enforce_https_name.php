<?php
function enforce_https_name(){
     $names = array();
     $names["de"] = "HTTPS Erzwingen";
     $names["en"] = "Enforce HTTPS";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
    }
