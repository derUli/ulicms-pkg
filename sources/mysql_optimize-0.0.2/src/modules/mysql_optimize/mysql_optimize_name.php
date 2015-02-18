<?php
function mysql_optimize_name(){
     $names = array();
     $names["de"] = "Datenbank optimieren";
     $names["en"] = "Optimize database";
    
     if(isset($names[$_SESSION["system_language"]])){
         return $names[$_SESSION["system_language"]];
         }else{
         return $names["de"];
         }
     }
