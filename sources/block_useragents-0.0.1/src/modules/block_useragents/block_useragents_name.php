<?php
function block_useragents_name(){
     $names = array();
     $names["de"] = "Useragents sperren";
     $names["en"] = "Block Useragents";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
    }
