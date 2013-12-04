<?php 
include getModulePath("unews")."unews_views.php";


function unews_render(){
   $single = null;
   $start = 0;

   if(isset($_GET["single"]))
      $single = trim($_GET["single"]);
      
   if(isset($_GET["start"]))
      $start = trim($_GET["start"]);
      
   if($single){
      return unews_single_view($single);
   }
   
   return unews_list_view($start);

}
?>