<?php
function placeholders_content_filter($txt){
  $query = db_query("SELECT * FROM `".tbname("placeholders")."` ORDER by name");
  while($row = db_fetch_assoc($query)){
     $txt = str_replace($row["name"], $row["value"], $txt);
  }

  return $txt;
}
