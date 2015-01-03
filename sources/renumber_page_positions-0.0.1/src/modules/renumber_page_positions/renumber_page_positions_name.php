<?php
function renumber_page_positions_name(){
     $names = array();
     $names["de"] = "Seitenpositionen neu organisieren";
     $names["en"] = "Reorganize Page Positions";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
