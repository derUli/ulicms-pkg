<?php
function gallery_name(){
     $names = array();
     $names["de"] = "Galerie";
     $names["en"] = "Gallery";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
