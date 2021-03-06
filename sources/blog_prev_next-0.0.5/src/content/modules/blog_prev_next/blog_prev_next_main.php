<?php
function blog_prev_next_render() {
	if (! isset ( $_GET ["single"] )){
		return "";
	}
	
	$html = "";
	
	$single = db_escape ( $_GET ["single"] );
	
	if (empty ( $single )){
		return "";
	}
	
	$query = db_query ( "SELECT datum FROM " . tbname ( "blog" ) . " WHERE seo_shortname='" . $single . "'" );
	$thisQuery = db_fetch_object ( $query );
	
	$prevQuery = db_query ( "SELECT title, seo_shortname FROM " . tbname ( "blog" ) . " WHERE datum < " . $thisQuery->datum . " AND language='" . db_escape ( $_SESSION ["language"] ) . "' ORDER by datum DESC LIMIT 1" );
	
	$nextQuery = db_query ( "SELECT title, seo_shortname FROM " . tbname ( "blog" ) . " WHERE datum > " . $thisQuery->datum . " AND language='" . db_escape ( $_SESSION ["language"] ) . "' ORDER by datum ASC LIMIT 1" );
	
	if (db_num_rows ( $prevQuery ) == 0 and db_num_rows ( $nextQuery ) == 0){
		return "";
	}
	
	$html .= "<div class=\"blogArticlePrevNext\">";
	
	if (db_num_rows ( $prevQuery ) > 0) {
		$html .= "<span class=\"blog_article_prev\">";
		$results = db_fetch_object ( $prevQuery );
		$html .= "<a href=\"" . get_slug () . ".html?single=" . htmlspecialchars ( $results->seo_shortname, ENT_QUOTES, "UTF-8" ) . "\">&laquo; " . htmlspecialchars ( $results->title, ENT_QUOTES, "UTF-8" ) . "</a>";
		$html .= "</span>";
	}
	
	if (db_num_rows ( $nextQuery ) > 0) {
		$html .= "<span class=\"blog_article_next\">";
		$results = db_fetch_object ( $nextQuery );
		$html .= "<a href=\"" . get_slug () . ".html?single=" . htmlspecialchars ( $results->seo_shortname, ENT_QUOTES, "UTF-8" ) . "\">" . htmlspecialchars ( $results->title, ENT_QUOTES, "UTF-8" ) . " &raquo;</a>";
		$html .= "</span>";
	}
	
	$html .= "</div>";
	
	return $html;
}
?>
