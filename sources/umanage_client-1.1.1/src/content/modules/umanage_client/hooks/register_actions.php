<?php
$module_name = "umanage_client";
$module_base_path = getModulePath($module_name, true) . "views";
global $actions;
$actions["umanage_list"] = $module_base_path . "/list.php";
$actions["umanage_clear_log"] = $module_base_path . "/clear_log.php";
$actions["umanage_new"] = $module_base_path . "/new.php";
$actions["umanage_edit"] = $module_base_path . "/edit.php";
$actions["umanage_check_for_patches"] = $module_base_path . "/check_for_patches.php";
$actions["check_for_package_updates"] = $module_base_path . "/check_for_package_updates.php";
$actions["umanage_install_patches"] = $module_base_path . "/install_patches.php";
$actions["umanage_install_packages"] = $module_base_path . "/install_packages.php";
$actions["optimize_db"] = $module_base_path . "/optimize_db.php";
$actions["upgrade_core"] = $module_base_path . "/upgrade_core.php";

include_once getModulePath($module_name, true) . "/objects/sites.php";
include_once getModulePath($module_name, true) . "/objects/connection.php";