<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "jquery_ui_samples" ) );
define ( MODULE_ADMIN_REQUIRED_PERMISSION, "info" );
function jquery_ui_admin() {
	?>
<p>
	<a id="jquery_ui_samples"
		href="<?php echo getModulePath("jquery_ui");?>" target="_blank">[<?php translate("open_jquery_ui_samples");?>]</a>
</p>
<script type="text/javascript">
$(function(){
	var link = $("a#jquery_ui_samples").first().attr("href");
	location.replace(link);
	
});
</script>
<?php
}