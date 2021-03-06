<?php

function blog_og_description_filter($txt) {
	$single = db_escape($_GET ["single"]);
	$query = db_query("SELECT content_preview, meta_description FROM `" . tbname("blog") . "` WHERE seo_shortname='$single'");
	$content_preview = false;

	if (!$query) {
		return $txt;
	}

	if (db_num_rows($query) > 0) {
		$result = db_fetch_assoc($query);
		$content_preview = $result ["content_preview"];
		if (!is_null($result ["meta_description"]) and ! empty($result ["meta_description"])) {
			$meta_description = trim($result ["meta_description"]);
			return real_htmlspecialchars($meta_description);
		}
	}

	if (!containsModule(get_slug(), "blog") or ! $single or ! $content_preview) {
		return $txt;
	}

	$maxlength_chars = 160;
	$content_preview = strip_tags($content_preview);

	// $shortstring = preg_replace('/(?:[ \t]*(?:\n|\r\n?)){2,}/', "\n", $shortstring);
	// Leerzeichen und Zeilenumbrüche entfernen
	$content_preview = trim($content_preview);
	$content_preview = preg_replace("#[ ]*[\r\n\v]+#", "\r\n", $content_preview);
	$content_preview = preg_replace("#[ \t]+#", " ", $content_preview);
	$content_preview = str_replace("\r\n", " ", $content_preview);
	$content_preview = str_replace("\n", " ", $content_preview);
	$content_preview = str_replace("\r", " ", $content_preview);
	$content_preview = str_replace("&nbsp;", " ", $content_preview);

	$content_preview = trim($content_preview);

	$shortstring = $content_preview;

	$word_count = str_word_count($shortstring);

	while (strlen($shortstring) > $maxlength_chars) {
		$shortstring = getExcerpt($content_preview, 0, $word_count);
		$word_count -= 1;
	}
	$shortstring = str_replace("\"", "'", $shortstring);
	$shortstring = str_replace("&quot;", "'", $shortstring);
	$shortstring = unhtmlspecialchars($shortstring);
	return $shortstring;
}

?>