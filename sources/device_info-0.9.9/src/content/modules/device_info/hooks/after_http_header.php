<?php
if (! is_logged_in ()) {
	if (is_ajax_request ()) {
		Database::query ( "Update `{prefix}device_infos` set ajax = ajax + 1", true );
	} else if (is_crawler ()) {
		Database::query ( "Update `{prefix}device_infos` set crawler = crawler + 1", true );
	} else if (is_mobile () and is_tablet ()) {
		Database::query ( "Update `{prefix}device_infos` set tablet = tablet + 1", true );
	} else if (is_mobile () and ! is_tablet ()) {
		Database::query ( "Update `{prefix}device_infos` set mobile = mobile + 1", true );
	} else {
		Database::query ( "Update `{prefix}device_infos` set pc = pc + 1", true );
	}
}
