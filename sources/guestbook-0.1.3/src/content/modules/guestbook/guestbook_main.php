<?php
if (! function_exists ( "stringcontainsbadwords" )) {
	function stringcontainsbadwords($str) {
		$words_blacklist = getconfig ( "spamfilter_words_blacklist" );
		$str = strtolower ( $str );
		
		if ($words_blacklist !== false) {
			$words_blacklist = explode ( "||", $words_blacklist );
		} else {
			return false;
		}
		
		for($i = 0; $i < count ( $words_blacklist ); $i ++) {
			$word = strtolower ( $words_blacklist [$i] );
			if (strpos ( $str, $word ) !== false)
				return true;
		}
		
		return false;
	}
}
function guestbook_render() {
	check_installation ();
	
	if (empty ( $_GET ["action"] )) {
		$action = "list";
	} else {
		$action = $_GET ["action"];
	}
	
	switch ($action) {
		case "list" :
			$html_output = guestbook_list ();
			break;
		case "delete" :
			$acl = new ACL ();
			if ($acl->hasPermission ( "guestbook" ) and isset ( $_GET ["delete"] )) {
				
				$delete = $_GET ["delete"];
				$delete = intval ( $delete );
				db_query ( "DELETE FROM `" . tbname ( "guestbook_entries" ) . "` WHERE id = " . $delete );
				$html_output = guestbook_list ();
			}
			break;
		case "add" :
			// validating guestbook entry
			$html_output = "";
			if (isset ( $_POST ["gb_submit"] )) {
				$errors = false;
				if (empty ( $_POST ["gb_name"] )) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms-error'>Bitte geben Sie einen Namen ein.</p>";
					} else {
						$html_output .= "<p class='ulicms-error'>Please enter your name.</p>";
					}
				}
				if (empty ( $_POST ["gb_city"] )) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms-error'>Bitte geben Sie einen Ort ein.</p>";
					} else {
						echo "<p class='ulicms-error'>Please enter a City.</p>";
					}
				}
				
				if (empty ( $_POST ["gb_mail"] )) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms-error'>Bitte geben Sie ihre Emailadresse ein.</p>";
					} else {
						$html_output .= "<p class='ulicms-error'>Please enter your mail adress.</p>";
					}
				}
				
				if (! empty ( $_POST ["gb_homepage"] )) {
					if (! startsWith ( $_POST ["gb_homepage"], "http://" )) {
						$_POST ["gb_homepage"] = "http://" . $_POST ["gb_homepage"];
					}
				}
				
				if (empty ( $_POST ["gb_content"] )) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms-error'>Bitte geben Sie eine Nachricht ein.</p>";
					} else {
						$html_output .= "<p class='ulicms-error'>Please enter a message.</p>";
					}
				}
				
				$badwords = file_get_contents ( getModulePath ( "guestbook" ) . "badwords.txt" );
				$badwords = explode ( "\n", $badwords );
				
				for($i = 0; $i < count ( $badwords ); $i ++) {
					
					if (strpos ( $_POST ["gb_content"], $badwords [$i] ) !== false) {
						if ($_SESSION ["language"] == "de") {
							$html_output .= "<p class='ulicms-error'>Sie haben ein nicht erlaubtes Wort in Ihrer Nachricht verwendet.</p>";
						} else {
							$html_output .= "<p class='ulicms-error'>You have used a bad word in your message.</p>";
						}
						break;
					}
				}
				
				$spamfilter_enabled = getconfig ( "spamfilter_enabled" ) == "yes";
				
				if ($spamfilter_enabled and (stringcontainsbadwords ( $_POST ["gb_name"] ) or stringcontainsbadwords ( $_POST ["gb_content"] ))) {
					if ($_SESSION ["language"] == "de") {
						$errors = true;
						$html_output .= "<p class='ulicms_error'>" . "Ihr Eintrag enthält nicht erlaubte Wörter.</p>";
					} else {
						$errors = true;
						$html_output .= "<p class='ulicms_error'>" . "Your comment contains not allowed words.</p>";
					}
				}
				
				// Filter nach chinesisch
				if (getconfig ( "disallow_chinese_chars" ) and $spamfilter_enabled and (AntispamHelper::isChinese ( $_POST ["gb_content"] ))) {
					
					$errors = true;
					
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms_error'>" . "Chinesische Schriftzeichen sind nicht erlaubt!</p>";
					} else {
						$html_output .= "<p class='ulicms_error'>" . "Chinese chars are not allowed!</p>";
					}
				}
				// Filter nach chinesisch
				if (getconfig ( "disallow_cyrillic_chars" ) and $spamfilter_enabled and (AntispamHelper::isCyrillic ( $_POST ["gb_content"] ))) {
					
					$errors = true;
					
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms_error'>" . "Kyrillische Schriftzeichen sind nicht erlaubt!</p>";
					} else {
						$html_output .= "<p class='ulicms_error'>" . "Cyrilic chars are not allowed!</p>";
					}
				}
				if ($_POST ["phone"] != "" and $spamfilter_enabled) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						
						$html_output .= "<p class='ulicms-error'>Spamschutz-Feld bitte leer lassen.</p>";
					} else {
						$html_output .= "<p class='ulicms-error'>Please let the field for spam protection empty</p>";
					}
				}
				
				if (getconfig ( "spamfilter_enabled" ) == "yes" and isCountryBlocked ()) {
					$errors = true;
					if ($_SESSION ["language"] == "de") {
						$html_output .= "<p class='ulicms-error'>Besucher aus Ihrem Land dürfen nicht kommentieren. Wenn Sie das für einen Fehler halten, wenden Sie sich bitte an den Administrator dieser Website.</p>";
					} else {
						$html_output .= "<p class='ulicms-error'>Visitors from your country can't comment
				       on this website.<br/>If you believe, this is an error, please contact the webmaster.</p>";
					}
				}
				
				if (! $errors) {
					$gb_name = db_escape ( htmlspecialchars ( $_POST ["gb_name"] ) );
					$gb_city = db_escape ( htmlspecialchars ( $_POST ["gb_city"] ) );
					$gb_mail = db_escape ( htmlspecialchars ( $_POST ["gb_mail"] ) );
					$gb_homepage = db_escape ( htmlspecialchars ( $_POST ["gb_homepage"] ) );
					$gb_content = db_escape ( nl2br ( htmlspecialchars ( $_POST ["gb_content"] ) ) );
					$date = date ( "Y-m-d H:i:s" );
					$sql = "INSERT INTO " . tbname ( "guestbook_entries" ) . " (name, ort, email, date, homepage, content)
					VALUES ('$gb_name', '$gb_city', '$gb_mail', '$date', '$gb_homepage', '$gb_content');";
					db_query ( $sql ) or die ( db_error () );
					
					$html_output .= guestbook_list ();
					return $html_output;
				}
			}
			$html_output .= get_add_entry_form ();
			break;
		default :
			$html_output = "Invalid Action specified";
			break;
	}
	
	// $html_output .= "<br/><br/><br/><center><small>Powered by Guestbook Module for UliCMS</small></center>";
	
	return $html_output;
}
function guestbook_get_add_entry_link() {
	if ($_SESSION ["language"] == "de") {
		return "<a href=\"" . "" . buildSEOUrl ( get_requested_pagename () ) . "?action=add" . "\">Eintrag hinzufügen</a><hr/>";
	} else {
		return "<a href=\"" . "" . buildSEOUrl ( get_requested_pagename () ) . "?action=add" . "\">Add Entry</a><hr/>";
	}
}
function get_add_entry_form() {
	if ($_SESSION ["language"] == "de") {
		$add_entry_form_template = file_get_contents ( getModulePath ( "guestbook" ) . "templates/add_entry_from_german.tpl" );
	} else {
		$add_entry_form_template = file_get_contents ( getModulePath ( "guestbook" ) . "templates/add_entry_from_english.tpl" );
	}
	$add_entry_form_template = str_replace ( "{form_action_url}", "" . buildSEOUrl ( get_requested_pagename () ) . "?action=add", $add_entry_form_template );
	$add_entry_form_template = str_replace ( "{csrf_token}", get_csrf_token_html (), $add_entry_form_template );
	return $add_entry_form_template;
}
function guestbook_list() {
	$acl = new ACL ();
	$html_output = "";
	if (empty ( $_GET ["limit"] )) {
		$limit = 10;
	} else {
		$limit = intval ( $_GET ["limit"] );
	}
	
	$html_output .= guestbook_get_add_entry_link ();
	$html_output .= "";
	$entries_query = db_query ( "SELECT * FROM " . tbname ( "guestbook_entries" ) . " ORDER by date DESC LIMIT $limit" );
	
	while ( $row = db_fetch_object ( $entries_query ) ) {
		
		if (! empty ( $row->homepage )) {
			$html_output .= "<a href=\"" . $row->homepage . "\" target=\"_blank\" rel=\"nofollow\">Homepage von " . $row->name . "</a>";
			
			$html_output .= "<br/><br/>";
		}
		
		$html_output .= "
		
		<small>" . $row->date . "</small>";
		if ($acl->hasPermission ( "guestbook" )) {
			$html_output .= ' &nbsp;&nbsp;[<a href="' . buildSEOUrl ( get_requested_pagename () ) . "?action=delete&delete=" . $row->id . '" onclick="return confirm(\'Diesen Eintrag löschen?\');">Löschen</a>]';
		}
		
		$html_output .= "
		<br/><br/>
		" . make_links_clickable ( $row->content ) . "<br/><br/><em>von " . $row->name . " aus " . $row->ort;
		
		$acl = new ACL ();
		
		if ($acl->hasPermission ( "guestbook" )) {
			$html_output .= " (<a href='mailto:" . $row->email . "'>" . $row->email . "</a>)";
		}
		
		$html_output .= "</em>";
		$html_output .= "<br/><br/><hr/>";
		
		$last = $row->id;
	}
	
	$html_output .= "<a id=\"gb_more\"></a>";
	if ($limit < $last) {
		$new_limit = $limit + 10;
		
		$html_output .= "<br/><br/><a href='" . buildSEOUrl ( get_requested_pagename () ) . "?action=list&limit=$new_limit#gb_more'>" . "Mehr</a>";
	}
	
	return $html_output;
}
function check_installation() {
	$test = db_query ( "SELECT * FROM " . tbname ( "guestbook_entries" ) );
	if (! $test) {
		require_once getModulePath ( "guestbook", true ) . "guestbook_install.php";
		guestbook_install ();
	}
}

?>
