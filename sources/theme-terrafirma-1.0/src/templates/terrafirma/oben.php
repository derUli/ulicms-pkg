<!DOCTYPE html>
<!--

	terrafirma1.0 by nodethirtythree design
	http://www.nodethirtythree.com

-->
<html>
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("terrafirma");
?>style.css"/>
<style type="text/css">
#header{
background-color:<?php echo getconfig("header-background-color");
?>;
}
</style>
</head>
<body>

<div id="outer">

	<div id="upbg"></div>

	<div id="inner">

		<div id="header">
			<h1><?php homepage_title()?></h1>
			<h2>by <?php homepage_owner();
?></h2>
		</div>
	
		<div id="splash"></div>
	
		<div id="menu">
			<ul>
				<?php menu("top");
?>
			</ul>

		<div id="date"><?php echo date("d.m.Y - H:i")?> Uhr</div>
		</div>
	

		<div id="primarycontent">
		
			<!-- primary content start -->
		
			<div class="post">
				<div class="header">
				<h3><?php headline();
?></h3>
					<div class="date"><?php echo date("d.m.Y - H:i")?> Uhr</div>
				</div>
				<div class="content">