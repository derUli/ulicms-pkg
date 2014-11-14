<?php 
function search_subjects_name(){
   $names = array();
   $names["de"] = "Suchbegriffe";
   $names["en"] = "Search Subjects";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}