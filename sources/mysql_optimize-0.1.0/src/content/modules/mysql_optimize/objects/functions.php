<?php

use UliCMS\Exceptions\SqlException;

if (!function_exists("db_optimize")) {

    function db_optimize($datase) {
        @set_time_limit(0);
        $obj = db_query('SHOW TABLES');

        while ($value = db_fetch_array($obj)) {
            echo "<p>";
            $value = $value[0];
            $repair_sql = 'REPAIR TABLE ' . $value;
            echo ($repair_sql) . " ";
            fcflush();
            try {
                Database::query($repair_sql);
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } catch (SqlException $e) {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo $e->getMessage();
            }
            echo "<br/>";
            $optimize_sql = 'OPTIMIZE TABLE ' . $value;
            echo $optimize_sql;
            fcflush();
            try {
                Database::query($optimize_sql);
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } catch (SqlException $e) {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo $e->getMessage();
            }

            echo "<br/>";
            $flush_sql = 'FLUSH TABLE ' . $value;
            echo $flush_sql;
            fcflush();
            try {
                Database::query($flush_sql);
                echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
            } catch (SqlException $e) {
                echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                echo "<br/>";
                echo $e->getMessage();
            }

            echo "</p>";
            fcflush();
        }
    }

}
