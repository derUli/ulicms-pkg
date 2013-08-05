<?php
// Execute PHP Codes in Pages
function exec_php_content_filter($content){
    
     ob_start();
     eval("?>$content<?php ");
     $output = ob_get_contents();
     ob_end_clean();
     return $output;
    
    }
