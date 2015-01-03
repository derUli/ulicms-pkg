<?php
function statistics_visitors_today_widget_render(){
    if(isModuleInstalled("statistics")){
        
         $heute = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
         $morgen = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
        
         $query = db_query("SELECT count(*) AS besucher_heute from " . tbname("statistics") . " WHERE date >= $heute AND date <= $morgen");
         $result = db_fetch_assoc($query);
         return $result["besucher_heute"];
        
        }else{
         return "statistics ist nicht installiert.";
        }
    
    }
