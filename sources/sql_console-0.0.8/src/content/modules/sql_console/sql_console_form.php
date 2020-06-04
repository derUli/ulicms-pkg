<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php csrf_token_html();?>
<p>
		<textarea name="sql_code" id="sql_code" class="codemirror"
			data-mimetype="text/x-sql"><?php echo htmlspecialchars($_SESSION["sql_code"])?></textarea>
	</p>
	<p>
		<input type="checkbox" id="sql_console_replace_placeholders"
			name="sql_console_replace_placeholders" value="1"
			<?php if($_SESSION["sql_console_replace_placeholders"]) echo "checked";?>>
		<label for="sql_console_replace_placeholders"><?php translate("sql_console_replace_placeholders")?></label>
	</p>
	<input type="submit" value="<?php translate("sql_console_execute");?>">
</form>
<?php 
BackendHelper::enqueueEditorScripts();
combinedScriptHtml();
?>