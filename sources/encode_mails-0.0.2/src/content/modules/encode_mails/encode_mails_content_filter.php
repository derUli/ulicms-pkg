<?php
function ascii_encode($string) {
	$encoded = '';
	for($i = 0; $i < strlen ( $string ); $i ++) {
		$encoded .= '&#' . ord ( substr ( $string, $i ) ) . ';';
	}
	
	return $encoded;
}
function SpamBlockEmail($string) {
	$pattern = "/([a-z|A-Z|0-9|\-|_|\.]*@[a-z|A-Z|0-9|\-|_]*\.[a-zA-Z]*)/";
	$replacement = " ascii_encode('$1'); ";
	$string = preg_replace_callback ( $pattern, function ($matches) {
		foreach ( $matches as $match ) {
			return ascii_encode ( $match );
		}
	}, $string );
	return $string;
}

// E-Mails kodieren um dumme E-Mail Crawler von Spammern daran zu hindern, die E-Mail Adressen zu indizieren
function encode_mails_content_filter($txt) {
	$txt = SpamBlockEmail ( $txt );
	
	return $txt;
}

