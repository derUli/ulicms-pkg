<?php
html5_doctype ();
og_html_prefix ();
?>
<head>
<?php
base_metas ();
og_tags ();
?>
<?php 
$modules = getAllModules ();
$hasSearch = (faster_in_array ( "search", $modules ) || faster_in_array ( "extended_search", $modules ));
$searchPage = ModuleHelper::getFirstPageWithModule ( "extended_search" );
if (! $searchPage) {
	$searchPage = ModuleHelper::getFirstPageWithModule ( "search" );
}
?>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css"
	href="<?php echo getTemplateDirPath(get_theme());?>mobile.css" />
<style type="text/css">
header, footer {
	background-color: <?php
	
echo getconfig ( "header-background-color" );
	?>;
}

h1, h2, h3, h4, h5, h6 {
	color: <?php
	
echo getconfig ( "header-background-color" );
	?>;
}

nav a.menu_active_link, nav a.contains-current-page {
	border-bottom: 3px solid<?php
	
echo getconfig ( "header-background-color" );
	?>;
}
</style>
<script>
	$(function(){
		$('ul.menu_top').slicknav({
           "prependTo" : "div#mobile-menu",
           "label" : "<?php translate("pages");?>",
           "allowParentLinks" : true
        });
	});
</script>
</head>
<body class="<?php body_classes();?>">
	<div class="grey-bar"></div>
	<header>
		<a href="./">
<?php
if (getconfig ( "logo_disabled" ) == "no") {
	logo ();
	?>
<br />
<?php
} else {
	?><strong><?php
	
	homepage_title ();
	?></strong>
<?php
}
?>
</a>
<?php
								
								if ((! containsModule ( null, "extended_search" ) and ! containsModule ( null, "search" )) and $hasSearch and $searchPage) {
									?>
		<form id="search-form-head" method="get"
				action="<?php Template::escape(buildSEOURL($searchPage->slug));?>">
				<input type="search" required="required" name="q"
					value="<?php  Template::escape($q);?>" results="10"
					autosave="<?php echo md5 ( $_SERVER ["SERVER_NAME"] );?>"
					placeholder="<?php translate("search");?>">
					
			</form>
        <?php }?>
	</header>
	<div id="root-container">
		<nav><?php menu("top");?></nav>
		<div id="mobile-menu"></div>
		<img class="header-image"
			src="<?php echo getTemplateDirPath(get_theme());?>header.jpg"
			alt="Header Grafik">
		<main>

<?php
Template::headline (); ?>
