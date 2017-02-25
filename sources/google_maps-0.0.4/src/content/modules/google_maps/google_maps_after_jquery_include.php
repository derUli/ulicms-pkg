<?php
if (containsModule ( get_requested_pagename (), "google_maps" )) {
	$google_maps_marker = getconfig ( "google_maps_marker" );
	$google_maps_api_key = Settings::get ( "google_maps_api_key" );
	$google_maps_zoom_level = getconfig ( "google_maps_zoom_level" );
	if ($google_maps_zoom_level === false or $google_maps_zoom_level == 0)
		$google_maps_zoom_level = 10;
	$custom_data = get_custom_data ();
	
	if (isset ( $custom_data ["google_maps_marker"] ) and ! empty ( $custom_data ["google_maps_marker"] )) {
		$google_maps_marker = $custom_data ["google_maps_marker"];
	}
	
	if (isset ( $custom_data ["google_maps_zoom_level"] ) and ! empty ( $custom_data ["google_maps_zoom_level"] )) {
		$google_maps_zoom_level = intval ( $custom_data ["google_maps_zoom_level"] );
	}
	
	if (isset ( $custom_data ["google_maps_api_key"] )) {
		$google_maps_api_key = $custom_data ["google_maps_api_key"];
	}
	
	if ($google_maps_marker and $google_maps_zoom_level) {
		?>
<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?key=<?php Template::escape($google_maps_api_key);?>"></script>

<script type="text/javascript"
	src="<?php
		
		echo getModulePath ( "google_maps" );
		?>gmap3.min.js"></script>



<link rel="stylesheet" type="text/css"
	href="<?php
		
		echo getModulePath ( "google_maps" );
		?>style.css" />



<script type="text/javascript">
      $(document).ready(function(){
        $('#gmap3').gmap3({
          marker:{
            address: "<?php
		
		echo real_htmlspecialchars ( $google_maps_marker );
		?>"
          },
          map:{
            options:{
              zoom: <?php
		
		echo real_htmlspecialchars ( $google_maps_zoom_level );
		?>
            }
          }
        });

      });

    </script>
<?php
	}
}

?>

