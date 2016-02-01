<?php
$page = get_page ();
if (isset ( $page ["lastmodified"] ) and $page ["lastmodified"] > 0) {
	translate ( "last_updated", array (
			"%date%" => strftime ( "%X %x", $page ["lastmodified"] ) 
	) );
}