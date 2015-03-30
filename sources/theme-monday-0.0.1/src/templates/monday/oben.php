<!doctype html>
<html lang="<?php echo getCurrentLanguage();
?>">
<head>
<?php base_metas()?>

<?php
if(in_array("search", getAllModules())){
     ?>
<script type="text/javascript">
/*
window.onload = function(){
  var qHead = document.getElementById("qHead")
  qHead.value = "Suchen";
  qHead.onfocus  = function(e){
     if(qHead.value == "Suchen"){
	    qHead.value = "";
	 }
	 
	 }
	 qHead.onblur  = function(e){
     if(qHead.value == ""){
	    qHead.value = "Suchen";
	 }
  }
}
*/
</script>

<?php }
?>
<style type="text/css">
#header{
background-color:<?php echo getconfig("header-background-color");
?>;
}
</style>
<meta name="viewport" content="width=1280"/>
</head>
<body>

<div id="rootContainer">
<div id="header">
<div id="logo">
<?php
if(getconfig("logo_disabled") != "yes"){
     echo '<a href="./">';
     logo();
     echo "</a>";
     }else{
     echo "<h1 class=\"website_name\">";
     echo '<a href="./">';
     homepage_title();
     echo "</a>";
     echo "</h1>";
     }
?>
<p class="motto"><?php motto();
?></p>
</div>
<?php
if(in_array("search", getAllModules())){
     ?>
<div id="searchFormHeader">
<form action="suche.html" method="get">
<input type="search" results=10 autosave="<?php echo md5($_SERVER["SERVER_NAME"]);
     ?>" id="qHead" name="q" value="">
<?php
     if(in_array("blog", getAllModules())){
        
         ?>
<input type="hidden" name="type" value="blog">
<?php }else{
         ?>
<input type="hidden" name="type" value="pages">

<?php }
     ?>

</form>
</div>
<?php }
?>
<?php menu("top");
?>
</div>

<div id="content">
