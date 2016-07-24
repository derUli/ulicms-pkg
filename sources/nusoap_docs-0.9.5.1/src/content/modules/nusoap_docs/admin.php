<?php
define ( "MODULE_ADMIN_HEADLINE", get_translation ( "nusoap_docs" ) );
define ( "MODULE_ADMIN_REQUIRED_PERMISSION", "info" );
function nusoap_docs_admin() {
	?>
<p>
	<a id="nusoap_docs_link"
		href="<?php echo getModulePath("nusoap_docs") . "docs/"?>"
		target="_blank">[<?php translate("open_nusoap_docs");?>]</a>
</p>
<script type="text/javascript">
$(function(){
	var link = $("a#nusoap_docs_link").first().attr("href");
	location.replace(link);
	
});
</script>
<?php
}