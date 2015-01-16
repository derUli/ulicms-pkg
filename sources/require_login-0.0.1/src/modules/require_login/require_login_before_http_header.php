<?php
if((containsModule(null, "require_login") or getconfig("require_login")) and !is_logged_in()){
   $url = "admin/?go=" . urlencode(getCurrentURL());
   ulicms_redirect($url);
}
