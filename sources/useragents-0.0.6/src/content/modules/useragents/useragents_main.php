<?php
function useragents_render() {
		return Template::escape( $_SERVER ['HTTP_USER_AGENT'] );
}
?>
