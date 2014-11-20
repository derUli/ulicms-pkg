<?php
function fullcalendar_name(){
     $names = array();
     $names["de"] = "Kalender";
     $names["en"] = "Calendar";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
    }
