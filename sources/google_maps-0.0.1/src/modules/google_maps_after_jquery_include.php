<?php
if(containsModule(get_requested_pagename(), "google_maps")){
     ?>
     
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript"><?php echo getModulePath("google_maps");
     ?>gmap3.min.js"></script>

<?php
     }
?>
