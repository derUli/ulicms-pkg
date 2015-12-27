<?php
function motd_frontend_render() {
	return '<div id="motd">' . getconfig ( "motd" ) . '</div>';
}
?>