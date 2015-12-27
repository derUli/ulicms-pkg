<?php
function tubular_content_filter($html) {
	$lib = getModulePath ( "stringparser_bbcode" ) . "/src/stringparser_bbcode.class.php";
	if (! file_exists ( $lib )) {
		return "Fehler stringparser_bbcode ist nicht installiert.";
	}
	
	include_once $lib;
	
	$bbcode = new StringParser_BBCode ();
	
	$before_html = "<script type=\"text/javascript\">
  $(document).ready(function() {
                $('#tubular').tubular({videoId: '";
	
	$after_html = "'}); // where idOfYourVideo is the YouTube ID.
        });</script>";
	
	$bbcode->addCode ( 'tubular', 'simple_replace', null, array (
			'start_tag' => $before_html,
			'end_tag' => $after_html 
	), 'inline', array (
			'block',
			'inline' 
	), array () );
	
	$html = $bbcode->parse ( $html );
	return $html;
}
?>