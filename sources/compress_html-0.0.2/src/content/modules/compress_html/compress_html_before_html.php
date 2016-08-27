<?php
function minify_html($buffer){
	$search = array("/>[[:space:]]+/", "/[[:space:]]+</");
	$replace = array(">","<");
	return preg_replace($search, $replace, $buffer);
}
ob_start ( 'minify_html' );