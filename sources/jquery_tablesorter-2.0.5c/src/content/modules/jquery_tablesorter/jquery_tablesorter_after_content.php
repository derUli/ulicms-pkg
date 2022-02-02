<?php
if (containsModule(get_slug(), "jquery_tablesorter")) {
    ?>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("table").tablesorter(); 
    } 
); 
    
</script>

<?php
}
?>
