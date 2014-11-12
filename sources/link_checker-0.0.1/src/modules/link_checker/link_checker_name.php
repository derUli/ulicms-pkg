<?php 
function link_checker_name(){
   $names = array();
   $names["de"] = "Links prüfen";
   $names["en"] = "Check links";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}