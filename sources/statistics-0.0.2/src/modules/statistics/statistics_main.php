<?php
function statistics_render(){
     $data = db_query("SELECT count(*) AS anzahl FROM " . tbname("statistics") . " ORDER by date ASC");
     $result = db_fetch_assoc($data);
     return $result["anzahl"];
     }
?>