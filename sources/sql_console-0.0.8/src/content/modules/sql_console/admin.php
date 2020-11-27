<?php
define("MODULE_ADMIN_HEADLINE", "SQL Console");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "sql_console");

// Session-Variable initialisieren
if (! isset($_SESSION["sql_code"])) {
    $_SESSION["sql_code"] = "";
}
if (! isset($_SESSION["sql_console_replace_placeholders"])) {
    $_SESSION["sql_console_replace_placeholders"] = true;
}

function sql_console_admin()
{
    include getModulePath("sql_console", true) . "sql_console_functions.php";
    
    include getModulePath("sql_console", true) . "sql_console_styles.php";
    if (Request::isPost()) {
        $_SESSION["sql_console_replace_placeholders"] = isset($_POST["sql_console_replace_placeholders"]);
        if (isset($_POST["sql_code"])) {
            sqlQueryFromString($_POST["sql_code"]);
            $_SESSION["sql_code"] = $_POST["sql_code"];
        }
    }
    
    include getModulePath("sql_console", true) . "sql_console_form.php";
    $config = new CMSConfig();
    db_select_db($config->db_database);
}
