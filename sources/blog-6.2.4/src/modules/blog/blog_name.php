<?php 
function blog_name(){
   $names = array();
   $names["de"] = "Blog";
   $names["en"] = "Blog";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}