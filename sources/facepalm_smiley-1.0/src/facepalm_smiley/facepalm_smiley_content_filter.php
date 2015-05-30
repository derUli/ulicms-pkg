<?php
function facepalm_smiley_content_filter($html){
   $dir = getModulePath ("facepalm_smiley");
   $imgurl = $dir . '/img/facepalm.gif';
   $itag = '<img src="' . $imgurl . '" alt="m(" class="wp-smiley" />';
   return preg_replace ('/[mM]\(/', $itag, $html);
}