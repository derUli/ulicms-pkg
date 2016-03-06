<?php
$page = get_page ();
if (! containsModule () and isset ( $page ["lastmodified"] ) and $page ["lastmodified"] > 0) {
	?>
<div class="last-updated">
<?php
	translate ( "last_updated", array (
			"%date%" => strftime ( "%X %x", $page ["lastmodified"] ) 
	) );
	
	?>
	</div>
<?php
}