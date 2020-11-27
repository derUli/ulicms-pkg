<?php
include_once getModulePath("search_subjects", true) . "search_engine_keywords.php";

if (! function_exists("crawlerDetect")) {
    function crawlerDetect()
    {
        if (isset($_SERVER ['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER ['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }
}

$search_query = get_search_query();

if ((! is_admin_dir() and ! crawlerDetect() and isset($_GET ["q"])) or (! is_admin_dir() and ! crawlerDetect() and ! empty($search_query))) {
    $subject = trim($_GET ["q"]);
    
    if (! empty($search_query)) {
        $subject = $search_query;
    }
    
    $subject = db_escape($subject);
    
    $query = db_query("SELECT id FROM " . tbname("search_subjects") . " WHERE `subject` = '$subject'");
    
    if (db_num_rows($query) > 0 and ! empty($subject)) {
        db_query("UPDATE " . tbname("search_subjects") . " SET `amount` = `amount` + 1 WHERE `subject` = '$subject'");
    } elseif (! empty($subject)) {
        db_query("INSERT INTO " . tbname("search_subjects") . " (`subject`, `amount`) VALUES ('$subject', 1)");
    }
}
