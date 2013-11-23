<?php
error_reporting(0);

$lib_file = getModulePath("mysql_optimize") . "mysql_optimize_lib.php";

if(file_exists($lib_file)){
   @include_once $lib_file;
   if(function_exists('db_optimize')){
      $cfg = new config();
	  ob_start();
	  @ignore_user_abort(1); // run script in background 
      @set_time_limit(0); // run script forever 
      db_optimize($cfg->db_database);
	  ob_get_clean();
	  
	  }
}