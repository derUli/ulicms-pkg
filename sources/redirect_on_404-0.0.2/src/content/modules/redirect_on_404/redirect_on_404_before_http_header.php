<?php
if (! is_admin_dir () and is_404 () and ! is_frontpage ()) {
	$redirect_on_404_to = Settings::get ( "redirect_on_404_to" );
	ulicms_redirect ( $redirect_on_404_to );
}
