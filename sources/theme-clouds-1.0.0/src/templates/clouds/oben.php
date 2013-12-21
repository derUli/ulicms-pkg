<!doctype html>
<html lang="<?php echo getCurrentLanguage();
?>">
<head>
<?php base_metas()?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo getTemplateDirPath("clouds");
?>style.css"/>
<?php
if(!getconfig("header-background-color")){
     setconfig("header-background-color", "rgb(35, 148, 96)");
     }

if(!getconfig("body-background-color")){
     setconfig("body-background-color", "rgb(255,255,255)");
     }


if(!getconfig("body-text-color")){
     setconfig("body-text-color", "rgb(0,0,0)");
     }


?>
<style type="text/css">
.header{
background-color:<?php echo getconfig("header-background-color");
?>;
}
</style>
<script src="<?php echo getTemplateDirPath("clouds");
?>js/jquery.spritely-0.6.js" type="text/javascript"></script>
 <script type="text/javascript">
            $(document).ready(function() {
                $('#far-clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 30});
                $('#near-clouds').pan({fps: 30, speed: 1, dir: 'left', depth: 70});

                        $('#far-clouds, #near-clouds').spStart();

$('.container').hide();
$('#menucontainer').hide();

$(".container").fadeIn();
$('#menucontainer').fadeIn();


$('#menubutton').click(function(){
$('#menucontent').slideToggle();

})


$('a').click(function(){
      var href= $(this).attr('href');
     
      // do animation
      $('.container').fadeOut( 500, function(){
      $('#menucontainer').fadeOut(500, function(){


            window.location=href;
});
            // go to link when animation completes

      })

      // over ride browser following link when clicked
      return false;
})

                
   });
    </script>
</head>
<div id="menucontainer">
<div id="menubutton">Seiten</div>
<div id="menucontent">
<?php menu("left");?>
</div>
</div>
<div class="container">
    <div id="far-clouds" class="far-clouds stage"></div>
    <div id="near-clouds" class="near-clouds stage"></div>

    <div class="mainContent">
<body>