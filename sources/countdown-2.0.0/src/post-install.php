<?php 
if(!getconfig("countdown_to_date")){
   // default is Neujahr
   $new_year = mktime(0, 0, 0, 1, 1, date("y") + 1)
   setconfig("countdown_to_date", strval($new_year));
   }
   
if(!getconfig("countdown_width"))
   setconfig("countdown_width", "200");
if(!getconfig("countdown_height"))
   setconfig("countdown_height", "30");
 
?>