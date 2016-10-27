<?php
class uManageConnection {
	private $api_key = "";
	private $url = "";
	public function __construct($api_key, $url) {
		$this->api_key = $api_key;
		$this->url = $url;
	}
	public function getInfo() {
		$uri = $this->url . "?umanage=get_info&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
	public function clearLog() {
		$uri = $this->url . "?umanage=clear_log&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
	public function checkForPatches() {
		$uri = $this->url . "?umanage=check_for_patches&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
	public function installPatches($patches) {
		$uri = $this->url . "?umanage=install_patches&patches=" . implode ( ";", $patches ) . "&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
	public function installPackages($packages) {
		$uri = $this->url . "?umanage=install_packages&packages=" . implode ( ";", $packages ) . "&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
	public function checkForPackageUpdates() {
		$uri = $this->url . "?umanage=check_for_package_updates&key=" . $this->api_key;
		$result = file_get_contents_wrapper ( $uri, true );
		$data = json_decode ( $result, true );
		if (! $data) {
			return null;
		}
		return $data;
	}
}