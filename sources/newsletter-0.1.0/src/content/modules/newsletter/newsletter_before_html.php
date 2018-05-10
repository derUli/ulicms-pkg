<?php
if (containsModule(get_requested_pagename(), "newsletter") and isset($_GET["code"])) {
    
    $code = db_escape($_GET["code"]);
    $sql = "UPDATE " . tbname ( "newsletter_subscribers" ) . "
   set `confirmed` = 1 WHERE
   md5(CONCAT(`email`, CAST(`subscribe_date` As CHAR(60)))) = '$code'";
    db_query($sql);
}
