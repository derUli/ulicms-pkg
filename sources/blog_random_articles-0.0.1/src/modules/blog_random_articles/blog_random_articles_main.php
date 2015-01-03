<?php
function blog_random_articles_render(){
     $html = "<ul class='blog_random_articles'>";
    
     $limit_sql = "";
    
     $limit_amount = getconfig("blog_sidebar_widget_amount");
     if($limit_amount){
         $limit_sql = " LIMIT " . $limit_amount;
         }
    else{
         return "<div class='ulicms_error'>Bitte setzen Sie die Konfigurationsvariable blog_sidebar_widget_amount</div>";
        
         }
    
    
     $blog_page_url = getconfig("blog_page_url");
     if(!$blog_page_url){
         return "<div class='ulicms_error'>Bitte setzen Sie die Konfigurationsvariable blog_page_url</div>";
         }
    
    
    
     $query = db_query("SELECT title, seo_shortname FROM " . tbname("blog") . " WHERE language='" . $_SESSION["language"] . "' ORDER by RAND() DESC" . $limit_sql);
     while($row = db_fetch_object($query)){
         $url = $blog_page_url . "?single=" . $row -> seo_shortname;
         $html .= "<li>" . "<a href=\"" . htmlspecialchars($url) . "\">" . htmlspecialchars($row -> title) . "</a></li>";
         }
    
     $html .= "</ul>";
    
    return $html;
    }
