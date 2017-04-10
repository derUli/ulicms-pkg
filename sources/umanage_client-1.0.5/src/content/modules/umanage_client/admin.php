<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "LIST_OF_REMOTE_SITES" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "umanage_client" );
function umanage_create_site() {
	$sql = "insert into " . tbname ( "umanage_sites" ) . " (protocol, domain, path, api_key) values(?, ?, ?, ?)";
	$args = array (
			$_REQUEST ["protocol"],
			$_REQUEST ["domain"],
			$_REQUEST ["path"],
			$_REQUEST ["api_key"] 
	);
	return Database::pQuery ( $sql, $args );
}
function umanage_delete_site() {
	$sql = "delete from " . tbname ( "umanage_sites" ) . " where id = ?";
	$args = array (
			$_REQUEST ["id"] 
	);
	return Database::pQuery ( $sql, $args );
}
function umanage_edit_site() {
	$sql = "update " . tbname ( "umanage_sites" ) . " set protocol = ?, domain = ?, path = ?, api_key = ? where id = ?";
	$args = array (
			$_REQUEST ["protocol"],
			$_REQUEST ["domain"],
			$_REQUEST ["path"],
			$_REQUEST ["api_key"],
			intval ( $_REQUEST ["id"] ) 
	);
	return Database::pQuery ( $sql, $args );
}
function umanage_client_admin() {
	if (StringHelper::isNotNullOrEmpty ( $_REQUEST ["form_action"] ) and function_exists ( "umanage_" . $_REQUEST ["form_action"] )) {
		call_user_func ( "umanage_" . $_REQUEST ["form_action"] );
	}
	Request::javascriptRedirect ( "index.php?action=umanage_list" );
}

