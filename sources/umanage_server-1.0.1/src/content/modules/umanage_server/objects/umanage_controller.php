<?php
include_once ULICMS_ROOT . "/templating.php";
$pkg = new PackageManager ();
$installed_patches = $pkg->getInstalledPatchNames ();
$installed_patches = implode ( ";", $installed_patches );
$version = new ulicms_version ();
if (! defined ( "PATCH_CHECK_URL" )) {
	define ( "PATCH_CHECK_URL", "http://patches.ulicms.de/?v=" . urlencode ( implode ( ".", $version->getInternalVersion () ) ) . "&installed_patches=" . urlencode ( $installed_patches ) );
}

include_once getModulePath ( "umanage_server" ) . "/objects/umanage_package_manger.php";
class UManageController {
	public static function handleRequest() {
		$response = array ();
		$key = $_REQUEST ["key"];
		if ($key != Settings::get ( "umanage_api_key" )) {
			$response ["error"] = "invalid_api_key";
		} else {
			switch ($_REQUEST ["umanage"]) {
				case "clear_log" :
					$response = self::clearLog ();
					break;
				case "check_for_package_updates" :
					$response = self::checkForPackageUpdates ();
					break;
				case "get_info" :
					$response = self::getInfos ();
					break;
				case "install_packages" :
					$response = self::installPackages ();
					break;
				case "check_for_patches" :
					$response = self::checkForPatches ();
					break;
				case "install_patches" :
					$response = self::installPatches ();
					break;
				default :
					$response ["error"] = "unknown_command";
					break;
			}
			$response = apply_filter ( $response, "umanage_response" );
		}
		
		return json_encode ( $response );
	}
	
	// @TODO: Funktion implementieren, zum Abfragen von Systeminfos (UliCMS Release Version, usw.)
	private static function getInfos() {
		$version = new ulicms_version ();
		$umanage_server_version = getModuleMeta ( "umanage_server", "version" );
		if (! defined ( "UPDATE_CHECK_URL" )) {
			define ( "UPDATE_CHECK_URL", "http://update.ulicms.de/?v=" . urlencode ( implode ( ".", $version->getInternalVersion () ) ) . "&update=" . urlencode ( $version->getUpdate () ) );
		}
		$isCoreCurrent = @file_get_contents_Wrapper ( UPDATE_CHECK_URL, true );
		$isCoreCurrent = ! isNotNullOrEmpty ( $isCoreCurrent );
		
		$info = array (
				"version" => cms_version (),
				"is_core_current" => $isCoreCurrent,
				"umanage_server_version" => $umanage_server_version 
		);
		return $info;
	}
	private static function installPackages() {
		$result = array ();
		if (isset ( $_REQUEST ["packages"] ) and ! empty ( $_REQUEST ["packages"] )) {
			$packages = explode ( ";", $_REQUEST ["packages"] );
			$packages = array_map ( "trim", $packages );
			$pkg = new uManagePackageManager ();
			$result = array (
					"ok" => array (),
					"failed" => array () 
			);
			foreach ( $packages as $package ) {
				ob_start ();
				if ($pkg->installRemotePackage ( $package )) {
					$result ["ok"] [] = $package;
				} else {
					$result ["failed"] [] = $package;
				}
				ob_end_clean();
			}
		} else {
			return array (
					"error" => "no_packages" 
			);
		}
		return $result;
	}
	private static function checkForPackageUpdates() {
		include_once getModulePath ( "update_manager" ) . "/objects/update_manager.php";
		$result = UpdateManager::getAllUpdateablePackages ();
		$response = array (
				"packages" => $result 
		);
		return $response;
	}
	private static function clearLog() {
		Database::query ( "TRUNCATE TABLE " . tbname ( "log" ) );
		return array (
				"result" => "ok" 
		);
	}
	private static function checkForPatches() {
		$result = array (
				"patches" => array () 
		);
		$text = file_get_contents_wrapper ( PATCH_CHECK_URL, true );
		$available = str_ireplace ( "\r\n", "\n", $text );
		$available = explode ( "\n", $available );
		foreach ( $available as $line ) {
			$line = trim ( $line );
			if (! empty ( $line )) {
				$splitted = explode ( "|", $line );
				if (count ( $splitted ) >= 3) {
					$result ["patches"] [] = $splitted;
				}
			}
		}
		return $result;
	}
	private static function installPatches() {
		$available_patches = self::checkForPatches ();
		$available_patches = $available_patches ["patches"];
		$result = array ();
		if (isset ( $_REQUEST ["patches"] ) and ! empty ( $_REQUEST ["patches"] )) {
			$patches = explode ( ";", $_REQUEST ["patches"] );
			$patches = array_map ( "trim", $patches );
			$pkg = new uManagePackageManager ();
			$result = array (
					"ok" => array (),
					"failed" => array () 
			);
			foreach ( $patches as $patch ) {
				foreach ( $available_patches as $avpatch ) {
					if ($avpatch [0] == $patch) {
						if ($pkg->installPatch ( $avpatch [0], $avpatch [1], $avpatch [2] )) {
							$result ["ok"] [] = $patch;
						} else {
							$result ["failed"] [] = $patch;
						}
					}
				}
			}
		} else {
			return array (
					"error" => "no_patches" 
			);
		}
		return $result;
	}
}
