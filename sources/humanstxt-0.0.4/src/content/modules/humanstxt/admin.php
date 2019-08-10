<?php
define("MODULE_ADMIN_HEADLINE", "humans.txt");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "humans_txt_edit");

function humanstxt_admin()
{
    $file = ULICMS_ROOT . "/humans.txt";
    $text = $_POST["text"];
    if (isset($_POST["submit"])) {
        file_put_contents($file, $text);
    }
    if (file_exists($file)) {
        $text = file_get_contents($file);
    } else {
        $text = "";
    }
    ?>
<script type="text/javascript">
fillTemplate = () => {
	
	bootbox.confirm("Vorlage laden?", () => {
	
     $("#message").html("Lade Vorlage");
     $("#loading").show();
     $("#message").show();
     $.ajax({
            url: "<?php
    
    echo getModulePath("humanstxt");
    ?>template.txt",
            async: true,
            success: function (data){
                $("textarea#text").val(data);
                $("textarea#text").focus()
                $("#message").html("");
                $("#loading").hide();
                $("#message").hide();
            }
        });
	});  
}
</script>
<form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<?php
    
    csrf_token_html();
    ?>
	<p>
		<a href="http://humanstxt.org"
		class="btn btn-info"
		target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i>
		Über humans.txt
		</a>
	</p>
	<p>
		<button type="button" onclick="fillTemplate();" class="btn btn-default">
			<i class="fas fa-file-alt"></i>
			Vorlage einfügen
		</button>
	</p>
	<p>
		<textarea id="text" rows="30" cols="80" style="width: 100%"
			name="text"><?php esc($text);?></textarea>
	</p>
	<p>
		<button
		type="submit"
		name="submit"
		class="btn btn-default">
			<i class="fa fa-save"></i>
			Datei Speichern
		</button>
	</p>
</form>
<?php
}
