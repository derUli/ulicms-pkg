<?php
function blog_og_url_filter($url){
   if(isset($_GET["single"])){
      $url .= "?single=".$_GET["single"];
   }
   return $url;
}