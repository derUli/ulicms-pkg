<?php

use UliCMS\Exceptions\SqlException;

if (!function_exists("db_optimize")) {

    function db_optimize($database, $output = true) {
        @set_time_limit(0);
        $obj = db_query('SHOW TABLES');

        while ($value = db_fetch_array($obj)) {
            if ($output) {
                echo "<p>";
            }
            $value = $value[0];
            $repair_sql = 'REPAIR TABLE ' . $value;
            if ($output) {
                echo($repair_sql) . " ";
                fcflush();
            }
            try {
                Database::query($repair_sql);
                if ($output) {
                    echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
                }
            } catch (SqlException $e) {
                if ($output) {
                    echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                    echo "<br/>";
                    echo $e->getMessage();
                }
            }

            if ($output) {
                echo "<br/>";
            }
            $optimize_sql = 'OPTIMIZE TABLE ' . $value;
            if ($output) {
                echo $optimize_sql;
                fcflush();
            }
            try {
                Database::query($optimize_sql);
                if ($output) {
                    echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
                }
            } catch (SqlException $e) {
                if ($output) {
                    echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                    echo "<br/>";
                    echo $e->getMessage();
                }
            }

            if ($output) {
                echo "<br/>";
            }
            $flush_sql = 'FLUSH TABLE ' . $value;

            if ($output) {
                echo $flush_sql;
                fcflush();
            }
            try {
                Database::query($flush_sql);

                if ($output) {
                    echo " <span style='color:green'>[" . get_translation("ok") . "]</span>";
                }
            } catch (SqlException $e) {
                if ($output) {
                    echo " <span style='color:red'>[" . get_translation("failed") . "]</span>";
                    echo "<br/>";
                    echo $e->getMessage();
                }
            }

            if ($output) {
                echo "</p>";
                fcflush();
            }
        }
    }

}
