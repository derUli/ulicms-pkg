<?php
if (is_logged_in() and containsModule(get_slug(), "blog")) {
	?>
	<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
	<?php
}
?>
<?php
if (containsModule(get_slug(), "blog") and ! (class_exists("GoogleCloudHelper") and GoogleCloudHelper::isProduction())) {
	?>
	<link rel="alternate" type="application/rss+xml" title="Blog Newsfeed"
		  href="blog_rss.php?s=<?php echo get_slug() ?>&amp;lang=<?php echo $_SESSION["language"] ?>" />
	<?php
}
?>
