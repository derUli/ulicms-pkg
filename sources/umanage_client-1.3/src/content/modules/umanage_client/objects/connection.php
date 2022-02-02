<?php

class uManageConnection
{
    private $api_key = "";
    private $url = "";

    public function __construct($api_key, $url)
    {
        $this->api_key = $api_key;
        $this->url = $url;
        
        set_time_limit(0);
    }

    public function getInfo()
    {
        $uri = $this->url . "?umanage=get_info&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function optimizeDB()
    {
        $uri = $this->url . "?umanage=optimize_db&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function checkForPatches()
    {
        $uri = $this->url . "?umanage=check_for_patches&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function installPatches($patches)
    {
        $uri = $this->url . "?umanage=install_patches&patches=" . implode(";", $patches) . "&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function installPackages($packages)
    {
        $uri = $this->url . "?umanage=install_packages&packages=" . implode(";", $packages) . "&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function checkForPackageUpdates()
    {
        $uri = $this->url . "?umanage=check_for_package_updates&key=" . $this->api_key;
        $result = file_get_contents_wrapper($uri, true);
        $data = json_decode($result, true);
        if (!$data) {
            return null;
        }
        return $data;
    }

    public function upgradeCore()
    {
        $uri = $uri = $this->url . "?umanage=upgrade_core&key=" . $this->api_key;
        $http = curl_init($uri);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);

        // do your curl thing here
        $result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        curl_close($http);
        if (in_array($http_status, array(
                    302,
                    303
                ))) {
            return true;
        }
        return $result;
    }
}
