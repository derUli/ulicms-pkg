<?php
$blog_rss = ULICMS_ROOT."/blog_rss.php";
if(file_exists($blog_rss ))
     @unlink($blog_rss);
?>