<?php
$antispam_field_name = getconfig ( "antispam_field_name" );
if (! $antispam_field_name) {
	$antispam_field_name = "fax";
}
if (isset ( $_GET ["submit-cms-form"] ) and ! empty ( $_GET ["submit-cms-form"] ) and get_request_method () === "POST" and Settings::get ( "spamfilter_enabled" ) == "yes") {
	if (! empty ( $_POST [$antispam_field_name] )) {
		$count = intval ( getconfig ( "contact_form_refused_spam_mails" ) ) + 1;
		setconfig ( "contact_form_refused_spam_mails", $count );
		die ( "Spam detected!" );
	}
	$id = intval ( $_GET ["submit-cms-form"] );
	if (Settings::get ( "disallow_chinese_chars" )) {
		$fields = Forms::getFieldsFromForm ( $id );
		$keys = array_keys ( $fields );
		foreach ( $keys as $key ) {
			if (is_chinese ( $_POST [$key] )) {
				translate ( "no_chinese_chars_allowed" );
				die ();
			}
		}
	}
	
	if (Settings::get ( "disallow_cyrillic_chars" )) {
		$fields = Forms::getFieldsFromForm ( $id );
		$keys = array_keys ( $fields );
		foreach ( $keys as $key ) {
			if (is_cyrillic ( $_POST [$key] )) {
				translate ( "no_cyrillic_chars_allowed" );
				die ();
			}
		}
	}
	
	if (isCountryBlocked ()) {
		translate ( "country_is_blocked" );
		die ();
	}
	
	if (Settings::get ( "check_for_spamhaus" ) and checkForSpamhaus ()) {
		$txt = get_translation ( "IP_BLOCKED_BY_SPAMHAUS" );
		
		$txt = str_replace ( "%ip", get_ip (), $txt );
		header ( "HTTP/1.0 403 Forbidden" );
		header ( "Content-Type: text/html; charset=UTF-8" );
		echo $txt;
		exit ();
	}
}