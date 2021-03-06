<?php
define("MODULE_ADMIN_HEADLINE", "RSS2Blog");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "rss2blog");

function rss2blog_admin()
{
    $srclist = getModulePath("rss2blog", true) . "etc/sources.ini";
    
    if (isset($_POST["submit"])) {
        file_put_contents($srclist, $_POST["list"]);
    }
    
    if (file_exists($srclist)) {
        $list = file_get_contents($srclist);
    } else {
        $list = "";
    }
    
    ?>

<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html();
    ?>
<p>Hier können Sie Ihren Blog automatisch aus externen RSS-Feeds mit
		Inhalten befüllen.</p>
	<p>
		Format<br /> URL User-ID
	</p>
	<p>
		Der Parameter URL muss die direkte Adresse zu einem RSS Newsfeed
		enthalten.<br /> Optional kann man getrennt durch einen Tabulator auch
		noch eine User-ID schreiben.<br /> Dem Beitrag wird dann der User mit
		dieser ID als Autor zugeordnet.
	</p>
	<p>
		<textarea rows="10" cols="80" style="width: 100%" name="list"><?php
    
    echo htmlspecialchars($list);
    ?></textarea>
	</p>

	<p>
		<button type="submit" name="submit" class="btn btn-success">Datei
			speichern</button>
	</p>
</form>
<?php
}

?>