<?php
function profiles_render() {
	ob_start ();
	
	if (! isset ( $_GET ["profile"] )) {
		profile_list ();
	} else {
		single_profile ( $_GET ["profile"] );
	}
	
	$html_output = ob_get_clean ();
	
	return $html_output;
}

// show a user profile
function single_profile() {
	$data = getUserByName ( $_GET ["profile"] );
	echo '<h3>' . $data ["username"] . '</h3>';
	echo "<p>";
	echo '<img src="' . get_gravatar ( $data ["email"], 200 ) . '" alt="Avatar ' . real_htmlspecialchars ( $data ["username"] ) . '"><br/><br/>';
	
	if ($data ["skype_id"]) {
		echo "<strong>Skype:</strong> " . $data ["skype_id"] . " ";
		echo '<a href="skype:' . $data ["skype_id"] . '?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_white_124x52.png" style="border: none;" width="124" height="52" alt="Skype Me™!" /></a>
<br /><a href="http://www.skype.com/go/download">Get Skype</a> and call me for free.<br /><br />';
	}
	echo "</p>";
	if ($data ["about_me"]) {
		echo "<h3>Über mich</h3>";
		echo "<p>";
		echo nl2br ( htmlspecialchars ( $data ["about_me"] ) );
		echo "</p>";
	}
}
function profile_list() {
	$users = getUsers ();
	echo "<ol>";
	for($i = 0; $i < count ( $users ); $i ++) {
		$data = getUserByName ( $users [$i] );
		echo "<li>" . '<a href="' . get_requested_pagename () . ".html?profile=" . $data ["username"] . '">' . $data ["username"] . "</a></li>";
	}
}

?>