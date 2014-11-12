<?php 
function mysql_backup_name(){
   $names = array();
   $names["de"] = "Datenbank Sicherung";
   $names["en"] = "Database Backup";
   
   if(isset($names[$_SESSION["system_language"]])){
      return $names[$_SESSION["system_language"]];
   } else {
      return $names["de"];
   }
}