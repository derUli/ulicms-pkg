<?php 
function countdown_name(){
   $names = array();
   $names["de"] = "Countdown";
   $names["en"] = "Countdown";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}