<script type="text/javascript"
	src="<?php
	
echo getModulePath ( "better_touch" );
	?>doubletaptogo.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".menu_top li:has(ul)").doubleTapToGo();
})
</script>
