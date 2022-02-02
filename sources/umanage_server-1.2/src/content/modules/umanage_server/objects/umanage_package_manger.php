<?php

class uManagePackageManager extends PackageManager
{
    public function installRemotePackage($package)
    {
        $pkg_src = Settings::get("pkg_src");
        @set_time_limit(0);
        $version = new UliCMSVersion();
        $internalVersion = implode(".", $version->getInternalVersion());
        $pkg_src = str_replace("{version}", $internalVersion, $pkg_src);

        $packageArchiveFolder = $pkg_src . "archives/" . $package . ".tar.gz";
        $pkgURL = $packageArchiveFolder;
        $pkgContent = @file_get_contents_wrapper($pkgURL);
        if (!$pkgContent or strlen($pkgContent) < 1) {
            return false;
        }

        if (!is_dir(ULICMS_TMP)) {
            mkdir(ULICMS_TMP, 0777);
        }

        $tmpFile = ULICMS_TMP . "/" . $package . ".tar.gz";

        // write downloaded tarball to file
        $handle = fopen($tmpFile, "wb");
        fwrite($handle, $pkgContent);
        fclose($handle);

        if (file_exists($tmpFile)) {
            // Paket installieren
            if ($this->installPackage($tmpFile)) {
                return true;
            } else {
                return false;
            }
            @unlink($tmpFile);
        } else {
            return false;
        }
    }
}
