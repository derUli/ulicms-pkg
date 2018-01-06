<?php
if (! function_exists("db_optimize")) {

    function db_optimize($datase)
    {
        @set_time_limit(0);
        $obj = db_query('SHOW TABLES');
        
        while ($value = db_fetch_array($obj)) {
            echo "<p>";
            $value = $value[0];
            $repair_sql = 'REPAIR TABLE ' . $value;
            echo ($repair_sql) . " ";
            fcflush();
            if (db_query($repair_sql)) {
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } else {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo db_error();
            }
            echo "<br/>";
            $optimize_sql = 'OPTIMIZE TABLE ' . $value;
            echo $optimize_sql;
            fcflush();
            if (db_query($optimize_sql)) {
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } else {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo db_error();
            }
            
            echo "<br/>";
            $flush_sql = 'FLUSH TABLE ' . $value;
            echo $flush_sql;
            fcflush();
            if (db_query($flush_sql)) {
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } else {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo db_error();
            }
            echo "</p>";
            fcflush();
        }
    }
}
