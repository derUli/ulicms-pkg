<?php
function placeholders_title_filter($txt){
     $query = db_query("SELECT * FROM `" . tbname("placeholders") . "` ORDER by name");
     while($row = db_fetch_assoc($query)){
         if($row["match_case"])
             $txt = str_replace($row["name"], $row["value"], $txt);
         else
             $txt = str_ireplace($row["name"], $row["value"], $txt);
         }
    
     return $txt;
    }
