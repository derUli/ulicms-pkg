<?php
if (isset ( $_REQUEST ["umanage"] ) and isset ( $_REQUEST ["key"] )) {
	require_once getModulePath ( "umanage_server" ) . "/objects/umanage_controller.php";
	echo UManageController::handleRequest ();
	die ();
}
