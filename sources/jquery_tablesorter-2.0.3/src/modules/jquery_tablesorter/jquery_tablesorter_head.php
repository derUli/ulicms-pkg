<?php 
if(containsModule(get_requested_pagename(), "jquery_tablesorter")){
?>
<script type="text/javascript" src="<?php echo getModulePath("jquery_tablesorter");?>jquery.tablesorter.min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo getModulePath("jquery_tablesorter");?themes/blue/style.css"/>
<?php }?>
