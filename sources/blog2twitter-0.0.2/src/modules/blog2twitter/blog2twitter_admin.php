<?php
define("MODULE_ADMIN_HEADLINE", "Einstellungen von blog2twitter");
define(MODULE_ADMIN_REQUIRED_PERMISSION, "blog2twitter_settings");


function blog2twitter_admin(){
    
     if(isset($_POST["submit"])){
        setconfig("blog2twitter_consumer_key", 
        db_escape($_POST["blog2twitter_consumer_key"]));
        
        setconfig("blog2twitter_consumer_secret", 
        db_escape($_POST["blog2twitter_consumer_secret"]));
        
        setconfig("blog2twitter_access_token", 
        db_escape($_POST["blog2twitter_access_token"]));
        
        setconfig("blog2twitter_access_token_secret", 
        db_escape($_POST["blog2twitter_access_token_secret"]));
            
      }

$blog2twitter_consumer_key = getconfig("blog2twitter_consumer_key");
$blog2twitter_consumer_secret = getconfig("blog2twitter_consumer_secret");
$blog2twitter_access_token = getconfig("blog2twitter_access_token");
$blog2twitter_access_token_secret = getconfig("blog2twitter_access_token_secret");
?>

<form id="blog2twitter_settings" action="<?php echo getModuleAdminSelfPath()?>" method="post">

<div class="label">Twitter Consumer Key</div>
<div class="inputWrapper"><input type="text" name="blog2twitter_consumer_key" value="<?php echo $blog2twitter_consumer_key;?>">
</div>
<div class="label">Twitter Consumer Secret</div>
<div class="inputWrapper"><input type="text" name="blog2twitter_consumer_secret" value="<?php echo $blog2twitter_consumer_secret;?>">
</div>

<div class="seperator"></div>

<div class="label">Twitter Access Token</div>
<div class="inputWrapper"><input type="text" name="blog2twitter_access_token" value="<?php echo $blog2twitter_access_token;?>">
</div>
<div class="label">Twitter Access Token Secret</div>
<div class="inputWrapper"><input type="text" name="blog2twitter_access_token_secret" value="<?php echo $blog2twitter_access_token_secret;?>">
</div>

<p><input type="submit" name="submit" value="Einstellungen speichern"/></p>
<script type="text/javascript">
$("#blog2twitter_settings").ajaxForm({beforeSubmit: function(e){
  $("#message").html("");
  $("#loading").show();
  }, 
  success:function(e){
  $("#loading").hide();  
  $("#message").html("<span style=\"color:green;\">Die Einstellungen wurden gespeichert.</span>");
  }
  

}); 

</script>
</form>
<?php
     }

?>