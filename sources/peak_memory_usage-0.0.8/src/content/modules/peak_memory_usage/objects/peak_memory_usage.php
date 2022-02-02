<?php
class PeakMemoryUsage
{
    public static function getMaximalUsage()
    {
        $retval = 0;
        $query = Database::query("select max(peak_memory_usage) as value from " . tbname("peak_memory_usage"));
        if (Database::getNumRows($query) > 0) {
            $data = Database::fetchObject($query);
            $retval = $data->value;
        }
        return $retval;
    }
    public static function getMinimalUsage()
    {
        $retval = 0;
        $query = Database::query("select min(peak_memory_usage) as value from " . tbname("peak_memory_usage"));
        if (Database::getNumRows($query) > 0) {
            $data = Database::fetchObject($query);
            $retval = $data->value;
        }
        return $retval;
    }
    public static function getAverageMemoryUsage()
    {
        $retval = 0;
        $query = Database::query("select avg(peak_memory_usage) as value from " . tbname("peak_memory_usage"));
        if (Database::getNumRows($query) > 0) {
            $data = Database::fetchObject($query);
            $retval = $data->value;
        }
        return $retval;
    }
    public static function getCount()
    {
        $retval = 0;
        $query = Database::query("select count(id) as value from " . tbname("peak_memory_usage"));
        if (Database::getNumRows($query) > 0) {
            $data = Database::fetchObject($query);
            $retval = $data->value;
        }
        return $retval;
    }
    public static function addDataset()
    {
        $usage = memory_get_peak_usage();
        return Database::query("insert into " . tbname("peak_memory_usage") . " (peak_memory_usage) values ($usage)");
    }
}
