<?php
define("MODULE_ADMIN_HEADLINE", "IP Whitelist");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "ip_whitelist");

function ip_whitelist_admin(){
    
     if(isset($_POST["submit"])){
         setconfig("ip_whitelist",
             db_escape($_POST["ip_whitelist"]));
        
         }
    
     $ip_whitelist = getconfig("ip_whitelist");
     $ip_whitelist = stringHelper :: real_htmlspecialchars($ip_whitelist);
     
     if(function_exists("get_ip")) 
   $your_ip = get_ip();
else
   $your_ip = $_SERVER['REMOTE_ADDR'];
     ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php if(function_exists("csrf_token_html")) csrf_token_html();?>
<?php translate("IP_WHITELIST_INSTRUCTION");?>
<?php echo str_replace("%ip%", $your_ip, get_translation("IP_WHITELIST_YOUR_IP"));?>
<p>
<textarea rows="10" cols="40" name="ip_whitelist"><?php echo $ip_whitelist;
     ?></textarea>

<p><input type="submit" name="submit" value="<?php translate("save_changes");?>"/></p>
</form>
<?php
     }

?>