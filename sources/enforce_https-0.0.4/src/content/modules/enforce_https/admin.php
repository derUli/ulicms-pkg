<?php
define("MODULE_ADMIN_HEADLINE", get_translation("enforce_https"));
define("MODULE_ADMIN_REQUIRED_PERMISSION", "settings_enforce_https");
function enforce_https_admin()
{
    if (isset($_POST ["submit"])) {
        if (isset($_POST ["enforce_https"])) {
            setconfig("enforce_https", "enforces");
        } else {
            deleteconfig("enforce_https");
        }
    }
    // Konfiguration checken
    $enforce_https = getconfig("enforce_https"); ?>
<form action="<?php echo getModuleAdminSelfPath(); ?>" method="post">
<?php
    
    csrf_token_html(); ?>
<?php
    
    if (! $enforce_https) {
        ?>
<p style="color: red">
		<?php translate("ENFORCE_HTTPS_INFO_MESSAGE_1", array("%link%" => Template::getEscape("https://".get_domain()))); ?>
	</p>
	<p style="color: red;">
		<?php translate("ENFORCE_HTTPS_INFO_MESSAGE_2")?>
	</p>
<?php
    } ?>
<p>
		<input type="checkbox" name="enforce_https" id="enforce_https"
			value="enforce"
			<?php
    
    if ($enforce_https) {
        echo " checked";
    } ?> /> <label for="enforce_https"><?php translate("ENFORCED_CONNECTION")?> </label>

	</p>



	<p>
		<input type="submit" name="submit"
			value="<?php translate("save_changes")?>" />
	</p>
</form>
<?php
}

?>
