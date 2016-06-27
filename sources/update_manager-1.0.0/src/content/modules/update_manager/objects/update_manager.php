<?php
class UpdateManager {
	public static function getAllUpdateablePackages() {
		$pkg = new packageManager ();
		$retval = array ();
		$modules = getAllModules ();
		if (count ( $modules ) > 0) {
			foreach ( $modules as $module ) {
				$version = getModuleMeta ( $module, "version" );
				if ($version != null) {
					$status = $pkg->checkForNewerVersionOfPackage ( $module );
					if (version_compare ( $status, $version, '>' )) {
						$retval [] = $module . "-" . $status;
					}
				}
			}
		}
		
		$themes = getThemeList ();
		if (count ( $themes ) > 0) {
			foreach ( $themes as $theme ) {
				$theme = "theme-" . $theme;
				$version = getModuleMeta ( $theme, "version" );
				if ($version != null) {
					$status = $pkg->checkForNewerVersionOfPackage ( $theme );
					if (version_compare ( $status, $version, '>' )) {
						$retval [] = $theme . "-" . $status;
					}
				}
			}
		}
		
		return $retval;
	}
}