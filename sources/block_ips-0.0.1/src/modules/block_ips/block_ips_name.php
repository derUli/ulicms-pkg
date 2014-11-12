<?php 
function block_ips_name(){
   $names = array();
   $names["de"] = "IP-Adressen sperren";
   $names["en"] = "Block IP Adresses";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}