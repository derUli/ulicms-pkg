<?php 
function guestbook_name(){
   $names = array();
   $names["de"] = "Gästebuch";
   $names["en"] = "Guestbook";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}