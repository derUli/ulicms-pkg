<?php
$data = get_custom_data();
if(!isset($data["disable_google_plusone"]) and is_200()){
     ?>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<?php }
