<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("touching_design");
?>style.css"/>
<style type="text/css">
#banner{
background-color:<?php echo getconfig("header-background-color");
?>;
}
</style>
</head>
<body>
 <!-- Generated at www.csscreator.com -->
<div id="container">
	<div id="banner">
		<div id='bannertitle'><?php homepage_title();?></div>
	</div>

	<div id="outer">
 		<div id="inner">
 			<div id="left">
  <div class="verticalmenu">
  <?php menu("left");?>
 </div> 

   		</div>
   		<div id="content">
