<?php

function blog_postlist_render(){
  $blog_page_url = getconfig("blog_page_url");
  if(!$blog_page_url){
    return '<p class="ulicms_error">Bitte setzen Sie die Konfigurationsvariable blog_page_url';
  }

  $sql = db_query("SELECT title, seo_shortname FROM ".tbname("blog"). 
" WHERE entry_enabled = 1 and language ='".$_SESSION["language"]."' order by datum DESC");
  $html = "<ul class='blog_postlist'>";
   while($row = db_fetch_object($sql)){
         $html .= '<li>'  ;
         $url = $blog_page_url."?single=".urlencode($row->seo_shortname);
         $html .= '<a href="'.$url.'">';
         $html .=  htmlspecialchars($row->title);
         $html .= "</a>";
         $html .='</li>';
   }

$html .= "</ul>";
   return $html;
}
