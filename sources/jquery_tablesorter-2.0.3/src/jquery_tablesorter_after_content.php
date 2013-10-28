<?php 
if(containsModule(get_requested_pagename(), "jquery_tablesorter")){
?>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("table").tablesorter(); 
    } 
); 
    
</script>
<?php } ?>
