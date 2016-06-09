<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation("BLOCK_IP_ADRESSES") );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "block_ips" );
function block_ips_admin() {
	if (isset ( $_POST ["submit"] )) {
		setconfig ( "blocked_ips", db_escape ( $_POST ["blocked_ips"] ) );
	}

	$blocked_ips = getconfig ( "blocked_ips" );
	$blocked_ips = stringHelper::real_htmlspecialchars ( $blocked_ips );
	?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php

	csrf_token_html ();
	?>
<p>
		Hier können Sie den Zugriff von bestimmten IP-Adressen auf das System
		blockieren.<br /> Sie können je einen Eintrag pro Zeile eingeben. <br />
		Wenn eine Zeile mit einem Punkt endet, werden alle IP-Adressen die
		damit anfangen blockiert.
	</p>
	<p>
		<textarea rows="10" cols="40" name="blocked_ips"><?php

	echo $blocked_ips;
	?></textarea>


	<p>
		<input type="submit" name="submit" value="<?php translate("save");?>" />
	</p>
</form>
<?php
}

?>
