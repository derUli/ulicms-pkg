<?php

if ((containsModule(null, "require_login") or Settings::get("require_login")) and!is_logged_in()) {
    $url = "admin/?go=" . urlencode(getCurrentURL());
    Request::redirect($url);
}
