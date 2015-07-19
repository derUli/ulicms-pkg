<?php
function get_Menutron($min = true){ 
   if($min)
     $file = "jQuery.menutron.min.js";
   else
     $file = "jQuery.menutron.js";

   return '<script src="'.getModulePath("Menutron").$file.'" type="text/javascript"></script>';
}


function Menutron($min = true){
   echo getMenutron($min);
}
