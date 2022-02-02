<?php
$language = getCurrentLanguage();
$jquery_cookiebar_message = Settings::getLang("jquery_cookiebar_message", $language);
$jquery_accept_text = Settings::getLang("jquery_accept_text", $language);
?>

<script type="text/javascript"
	src="<?php echo getModulePath("jquery_cookiebar")?>jquery.cookiebar.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var options = {
				message : "<?php echo Template::escape($jquery_cookiebar_message);?>",
				acceptText : "<?php echo Template::escape($jquery_accept_text);?>"
			}
		$.cookieBar(options);
	});
	</script>
