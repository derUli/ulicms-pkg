<?php
if(!is_admin_dir() and is_404() and !is_frontpage()){
  ulicms_redirect("./");
}
