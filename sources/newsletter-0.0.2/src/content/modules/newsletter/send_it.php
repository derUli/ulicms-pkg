<?php
if(!defined("ULICMS_ROOT")){
     die("Hacker saugen!");
     }

if(isset($_SESSION["newsletter_data"])){
     @ignore_user_abort(1); // run script in background 
     @set_time_limit(0); // run script forever 
     // Start send loop
    send_loop();
     }


?>