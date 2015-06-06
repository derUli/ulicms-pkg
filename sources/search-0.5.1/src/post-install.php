<?php

global $db_connection;

$require_change_engine = (mysqli_get_server_version ( $db_connection ) < 50600);

if($require_change_engine){
        db_query("ALTER TABLE ".tbname("content"). " ENGINE=MyISAM");
}

db_query("ALTER TABLE " . tbname("content") . " ADD fulltext(systemname, title, content, meta_description, meta_keywords)");

if(in_array("blog", getAllModules())){
     if($require_change_engine){
        db_query("ALTER TABLE ".tbname("blog"). " ENGINE=MyISAM");
        db_query("ALTER TABLE ".tbname("blog_comments"). " ENGINE=MyISAM");
     }
     
     db_query("ALTER TABLE " . tbname("blog") . " ADD fulltext(seo_shortname, title, content_full, content_preview)");
     db_query("ALTER TABLE " . tbname("blog_comments") . " ADD fulltext(name, url, comment)");
     

    
     }

if(in_array("fullcalendar", getAllModules())){
     if($require_change_engine){
        db_query("ALTER TABLE ".tbname("events"). " ENGINE=MyISAM");
}

     db_query("ALTER TABLE " . tbname("events") . " ADD fulltext(title, url)");

     }
    

?>