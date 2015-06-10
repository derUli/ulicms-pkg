<?php
// UliCMS Suchfunktions-Modul
// Version 0.3
// Neu: Jetzt indizierte Volltextsuche
function search_render(){
     $html_output = "";
    
     if(!empty($_GET["q"])){
         $search_subject = htmlspecialchars($_GET["q"],
             ENT_QUOTES, "UTF-8");
         }else{
         $search_subject = "";
         }
    
     if(isset($_GET["type"])){
         switch($_GET["type"]){
         case "blog":
             $type = "blog";
             break;
         case "comments":
             $type = "comments";
             break;
         case "events":
             $type = "events";
             break;
         case "pages": default:
             $type = "pages";
             break;
             break;
             }
         }else{
         $type = "pages";
         }
    $html_output .= "<div class=\"search-container\">";
     $html_output .= "<form class='search-form' action='" . buildSEOUrl(get_requested_pagename()) . "' method='get'>
	<div class=\"search_subject\">".TRANSLATION_SEARCH_SUBJECT.": <input type='search' results=10 autosave='" . md5($_SERVER["SERVER_NAME"]) . "' name='q' required='true' value='" . $search_subject . "'> <input type='submit' value='".TRANSLATION_DO_SEARCH."'></div>";
    
     $html_output .= '<br/><div class="search-content-type">';
     $html_output .= "<strong>".TRANSLATION_AREA.":</strong><br/><input type='radio' value='pages' id='radio_btn_pages' name='type' ";
     if($type == "pages"){
         $html_output .= " checked";
         }
     $html_output .= "><label for='radio_btn_pages'>".TRANSLATION_PAGES."</label><br/>";
    
    
     if(in_array("blog", getAllModules())){
        
         $html_output .= "<input type='radio' value='blog' id='radio_btn_blog' name='type' ";
        
         if($type == "blog"){
             $html_output .= " checked";
             }
         $html_output .= "><label for='radio_btn_blog'>".TRANSLATION_BLOG."</label><br/>";
        
        
         $html_output .= "<input type='radio' value='comments' name='type' id='radio_btn_comments' ";
        
         if($type == "comments"){
             $html_output .= " checked";
             }
         $html_output .= "><label for='radio_btn_comments'>".TRANSLATION_COMMENTS."</label><br/>";
        
        
         }
    
     if(in_array("fullcalendar", getAllModules())){
        
         $html_output .= "<input type='radio' value='events' name='type' id='radio_btn_events' ";
        
         if($type == "events"){
             $html_output .= " checked";
             }
         $html_output .= "><label for='radio_btn_events'>".TRANSLATION_EVENTS."</label><br/>";
        
         }
    
    
     $html_output .= "</div></form>";
    
     if(!empty($_GET["q"])){
         $search_request = $_GET["q"];
         $search_request_unencoded = $_GET["q"];
         $search_request = str_replace("&", "&amp;", $search_request);
         $search_request = str_replace("\"", "&quot;", $search_request);
         $search_request = str_replace("ö", "&ouml;", $search_request);
         $search_request = str_replace("Ö", "&Ouml;", $search_request);
         $search_request = str_replace("ü", "&uuml;", $search_request);
         $search_request = str_replace("Ü", "&Uuml;", $search_request);
         $search_request = str_replace("ä", "&auml;", $search_request);
         $search_request = str_replace("Ä", "&Auml;", $search_request);
         $search_request = str_replace("ß", "&szlig;", $search_request);
         $search_request = db_escape($search_request);
         $search_request_unencoded = db_escape($search_request_unencoded);
        
         $boolean_mode = getconfig("search_enable_boolean_mode");
         if($boolean_mode){
            $boolean_mode = " IN BOOLEAN MODE";
         } else{
            $boolean_mode = "";
         }
         if($type == "pages"){
             $search_sql_query = "SELECT systemname, title FROM " . tbname("content") .
             " WHERE MATCH (systemname, title, content, meta_description, meta_keywords) " .
             "AGAINST ('" . $search_request_unencoded . "'".$boolean_mode.");";
             $results = db_query($search_sql_query)or die(db_error());
             $result_count = db_num_rows($results);
             $html_output .= "<p class='search-results'><strong>$result_count</strong> ".TRANSLATION_SEARCH_RESULTS_FOUND."</p>";
             if($result_count > 0){
                
                 $html_output .= "<hr/>
		<ol class='result-list'>";
                 while($row = db_fetch_assoc($results)){
                     $html_output .= "<li><a href='" .
                     buildSEOUrl($row["systemname"]) . "'>" .
                     htmlspecialchars($row["title"], ENT_QUOTES, "UTF-8") . "</a></li>";
                    
                     }
                 $html_output .= "</ol>";
                 }
            
            
             }else if($type == "blog"){
            
             $blog_page = getconfig("blog_page");
             if(!$blog_page)
                 $blog_page = "blog";
            
             $search_sql_query = "SELECT seo_shortname, title FROM " . tbname("blog") .
             " WHERE MATCH (seo_shortname, title, content_full, content_preview) " .
             "AGAINST ('" . $search_request_unencoded . "'".$boolean_mode.") ORDER by datum DESC" .
             "";
             $results = db_query($search_sql_query);
             $result_count = db_num_rows($results);
             $html_output .= "<p class='search-results'><strong>$result_count</strong> ".TRANSLATION_SEARCH_RESULTS_FOUND."</p>";
             if($result_count > 0){
                
                 $html_output .= "<hr/>
		<ol class='result-list'>";
                 while($row = db_fetch_assoc($results)){
                     $html_output .= "<li><a href='" . buildSEOUrl($blog_page) . "?single=" . htmlspecialchars($row["seo_shortname"], ENT_QUOTES, "UTF-8") . "'>" . htmlspecialchars($row["title"], ENT_QUOTES, "UTF-8") . "</a></li>";
                    
                     }
                 $html_output .= "</ol>";
                 }
            
            
            
             }else if($type == "comments"){
            
             $blog_page = getconfig("blog_page");
             if(!$blog_page)
                 $blog_page = "blog";
            
             $search_sql_query = "SELECT * FROM " . tbname("blog_comments") .
             " WHERE MATCH (comment, name, url) " .
             "AGAINST ('" . $search_request_unencoded . "'".$boolean_mode.")";
             $results = db_query($search_sql_query);
             $result_count = db_num_rows($results);
             $html_output .= "<p class='search-results'><strong>$result_count</strong> ".TRANSLATION_SEARCH_RESULTS_FOUND."</p>";
             if($result_count > 0){
                
                 $html_output .= "<hr/>
		<ol class='result-list'>";
                 while($row = db_fetch_assoc($results)){
                     $query2 = db_query("SELECT * FROM " . tbname("blog") . " WHERE id=" . $row["post_id"]);
                     if(db_num_rows($query2) > 0){
                         $row2 = db_fetch_assoc($query2);
                         $html_output .= "<li><a href='" . buildSEOUrl($blog_page) . "?single=" . htmlspecialchars($row2["seo_shortname"], ENT_QUOTES, "UTF-8") . "#comment" . $row["id"] . "'>" . "Kommentar #" . $row["id"] . " von " . htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8") . " zu \"" . htmlspecialchars($row2["title"], ENT_QUOTES, "UTF-8") .
                         "\"" . "</a></li>";
                        
                        
                         }
                     }
                 $html_output .= "</ol>";
                 }
            
            
            
             }else if($type == "events"){
            
             $search_sql_query = "SELECT * FROM " . tbname("events") .
             " WHERE MATCH (title, url) " .
             "AGAINST ('" . $search_request_unencoded . "'".$boolean_mode.") AND `start` > " . (time() - 60 * 60 * 23) . " ORDER by `start` ASC";
            
             $results = db_query($search_sql_query);
             $result_count = db_num_rows($results);
             $html_output .= "<p class='search-results'><strong>$result_count</strong> ".TRANSLATION_SEARCH_RESULTS_FOUND."</p>";
             if($result_count > 0){
                
                 $html_output .= "<hr/>
		<ol class='result-list'>";
                 while($row = db_fetch_assoc($results)){
                     $dateString = date("d.m.Y", $row["start"]);
                     if($row["start"] != $row["end"]){
                         $dateString .= " - " . date("d.m.Y", $row["end"]);
                         }
                     if(!empty($row["url"])){
                         $html_output .= "<li><a href='" . htmlspecialchars($row["url"], ENT_QUOTES, "UTF-8") . "'>" . $dateString . " " . htmlspecialchars($row["title"], ENT_QUOTES, "UTF-8") . "</a></li>";
                         }else{
                         $html_output .= "<li>" . $dateString . " " . htmlspecialchars($row["title"], ENT_QUOTES, "UTF-8") . "</li>";
                        
                         }
                     }
                 $html_output .= "</ol>";
                 }
            
            
            
             }
         }
         
         
    $html_output .= "</div>";
     return $html_output;
     }
?>