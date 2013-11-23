<?php
function mysql_optimize_render(){
     ob_start();
     include_once getModulePath("mysql_optimize")."mysql_optimize_lib.php";
	 $cfg = new config();
	 db_optimize($cfg->db_database);
	    return ob_get_clean();
     }
?>