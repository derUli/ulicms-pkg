<?php

$disabled_on_pages = getconfig("jquery_disabled_on");
$disabled_on_pages = trim($disabled_on_pages);
$disabled_on_pages = explode(";", $disabled_on_pages);

if(!in_array(get_requested_pagename(), $disabled_on_pages)){
     ?>
<script type="text/javascript" src="<?php echo getModulePath("jquery")?>jquery-1.11.1.js"></script>
<?php
     add_hook("after_jquery_include");
     }
?>