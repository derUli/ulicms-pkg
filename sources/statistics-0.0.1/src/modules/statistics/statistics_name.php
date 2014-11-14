<?php 
function statistics_name(){
   $names = array();
   $names["de"] = "Besucherstatistiken";
   $names["en"] = "Visitor Statistics";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}