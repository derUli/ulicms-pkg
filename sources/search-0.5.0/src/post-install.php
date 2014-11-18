<?php

db_query("ALTER TABLE " . tbname("content") . " ADD fulltext(systemname, title, content, meta_description, meta_keywords)");

if(in_array("blog", getAllModules())){
     db_query("ALTER TABLE " . tbname("blog") . " ADD fulltext(seo_shortname, title, content_full, content_preview)");
     db_query("ALTER TABLE " . tbname("blog_comments") . " ADD fulltext(name, url, comment)");
    
     }

if(in_array("fullcalendar", getAllModules())){
     db_query("ALTER TABLE " . tbname("events") . " ADD fulltext(title, url)");
     }

?>