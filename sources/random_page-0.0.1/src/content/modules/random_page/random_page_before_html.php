<?php
$allpages = getAllSystemNames ();
if (containsModule ( get_requested_pagename (), "random_page" ) or isset ( $_GET ["view_random_page"] )) {
	$random = null;
	do {
		$random = array_rand ( $allpages, 1 );
		$random = $allpages [$random];
		$page = get_page ( $random );
		$redirection = $page ["redirection"];
	} while ( startsWith ( $redirection, "#" ) or containsModule ( $random ) );
	// Todo, keine Seiten mit Hash-URL dürfen ausgewählt werden.
	header ( "Location: " . buildSEOUrl ( $random ) );
	exit ();
}
