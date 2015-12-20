<h2 class="accordion-header"><?php
translate ( "joke" );
?></h2>
<div class="accordion-content">
<?php
include_once getModulePath ( "witz" ) . "witz_lib.php";
echo witz_get ();
?>
</div>