<?php
// Ersetze doppelte Anführungszeichen durch Typographische
function typographic_quotes_title_filter($input) {
	$input = preg_replace ( '#\"(.+)\"#iUs', '„$1“', $input ); // Unicode
	return $input;
}
?>