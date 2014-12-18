<?php 
function google_maps_render(){

   $google_maps_marker = htmlspecialchars("google_maps_marker", ENT_QUOTES, "UTF-8");
   
   $google_zoom_level = getconfig("google_zoom_level");
   
   if($google_zoom_level === false or $google_zoom_level == 0)
      $google_zoom_level = 10;
      
    if(!$google_maps_marker or empty($google_maps_marker)){
       return "Bitte geben Sie einen Ort für die Google Maps Karte an.";
    }
    
    

}