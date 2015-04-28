<?php
include_once ULICMS_ROOT."/templating.php";
if(!is_admin_dir() and containsModule(null, "phpContact")){
   no_anti_csrf();
}