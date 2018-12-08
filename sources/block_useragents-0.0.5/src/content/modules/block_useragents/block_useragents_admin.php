<?php
define("MODULE_ADMIN_HEADLINE", "User-Agents blockieren");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "block_useragents");

function block_useragents_admin()
{
    if (isset($_POST["submit"])) {
        setconfig("blocked_useragents", db_escape($_POST["blocked_useragents"]));
    }
    
    $blocked_useragents = getconfig("blocked_useragents");
    $blocked_useragents = StringHelper::realHtmlSpecialchars($blocked_useragents);
    ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html();
    ?>
<p>
		Hier können Sie den Zugriff von Clients mit bestimmten Useragents auf
		das System blockieren.<br /> Sie können einen Eintrag pro Zeile
		eingeben.
	</p>
	<p>
		<textarea rows="10" cols="80" style="width: 100%"
			name="blocked_useragents"><?php
    
    echo $blocked_useragents;
    ?></textarea>
	
	
	<p>
		<input type="submit" name="submit" value="Einstellungen speichern" />
	</p>
</form>
<?php
}

?>