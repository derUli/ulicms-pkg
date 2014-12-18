<?php
if(containsModule(get_requested_pagename(), "google_maps")){

   $google_maps_marker = htmlspecialchars("google_maps_marker", ENT_QUOTES, "UTF-8");
   
   $google_zoom_level = getconfig("google_zoom_level");
   
   if($google_zoom_level === false or $google_zoom_level == 0)
      $google_zoom_level = 10;
      
if($google_maps_marker and !empty($google_maps_marker)){
     ?>
     
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo getModulePath("google_maps"); ?>gmap3.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo getModulePath("google_maps"); ?>style.css"/>

 <script type="text/javascript">
      $(function(){
        $('#gmap3').gmap3({
          marker:{
            address: "<?php echo $google_maps_marker;?>"
          },
          map:{
            options:{
              zoom: <?php echo intval($google_zoom_level);?>
            }
          }
        });
      });
    </script>

 

<?php

}
     }
?>
