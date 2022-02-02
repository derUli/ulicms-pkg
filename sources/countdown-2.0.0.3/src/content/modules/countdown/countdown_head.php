<?php
if (containsModule(get_slug(), "countdown")) {
    ?>
<script type="text/javascript"
	src="<?php
    
    echo getModulePath("countdown") . "countdown.js"; ?>"></script>
<script type="text/javascript">
<?php
    
    include getModulePath("countdown", true) . "countdown-config.php"; ?>
</script>
<?php
}

?>