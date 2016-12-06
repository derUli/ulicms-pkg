<?php
if (containsModule ( get_requested_pagename (), "countdown" )) {
	?>
<script type="text/javascript"
	src="<?php
	
echo getModulePath ( "countdown" ) . "countdown.js";
	?>"></script>
<script type="text/javascript">
<?php
	
include getModulePath ( "countdown" ) . "countdown-config.php";
	?>
</script>
<?php

}

?>