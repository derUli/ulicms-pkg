<?php
if (! function_exists("renumber_page_positions")) {
    function renumber_page_positions()
    {
        return db_query("update " . tbname("content") . " set position = position * 10;");
    }
}
