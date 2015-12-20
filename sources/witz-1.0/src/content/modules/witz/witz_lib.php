<?php
function witz_get() {
	return file_get_contents_wrapper ( "http://www.hahaha.de/witze/zufallswitz.txt.php", true );
}

?>
