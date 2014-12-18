<?php 
function google_maps_render(){

    $google_maps_marker = getconfig("google_maps_marker");
    if(!$google_maps_marker or empty($google_maps_marker)){
       return "Bitte geben Sie einen Ort für die Google Maps Karte an.";
    }

    return '<div id="gmap3"></div>';
    

}