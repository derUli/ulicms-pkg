<?php
$confirm_timeout = 60 * 60 * 24 * 7;

db_query("DELETE FROM ".tbname("newsletter_subscribers"). " WHERE ".time().
" - `subscribe_date` > ".$confirm_timeout." AND confirmed = 0");

?>