<?php
function lightbox_gallery_name(){
     $names = array();
     $names["de"] = "Lightbox Galerie";
     $names["en"] = "Lightbox Gallery";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
