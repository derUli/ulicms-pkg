<?php

// Hier URL zu Drucksymbol einfügen
define("PRINT_ICON_URL", "/content/images/drucksymbol.gif");

if(in_array("print_version", getAllModules())){
    // Diese Funktion hier muss in einem Template aufgerufen werden,
    // um den Drucklink für die aktuelle Seite auszugeben.
    function printVersionLink(){
         $url = getCurrentURL();
        
         if(strpos($url, '?') !== false)
             $url = $url . "&print";
         else
             $url = $url . "?print";
        
         $url = htmlspecialchars($url);
         $html = "<a href=\"$url\" rel=\"nofollow\" target=\"_blank\"><img src=\"" . PRINT_ICON_URL . "\" alt=\"Drucken\" title=\"Drucken\"></a>";
        
         echo $html;
        }
    
    }else{
     // dummy function
    function printVersionLink(){
    }
    }

?>