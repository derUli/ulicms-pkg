<?php
define("MODULE_ADMIN_HEADLINE", "humans.txt");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "humans.txt_edit");

function humanstxt_admin(){
     $file = ULICMS_ROOT . "/humans.txt";
     $text = $_POST["text"];
     if(isset($_POST["submit"])){
         file_put_contents($file, $text);
        
         }
     if(file_exists($file)){
         $text = file_get_contents($file);
         $text = stringHelper :: real_htmlspecialchars($text);
         }
    else{
         $text = "";
         }
     ?>
<script type="text/javascript">
function fillTemplate(){
     $("#message").html("Lade Vorlage");
     $("#loading").show();
     $("#message").show();
     $.ajax({
            url: "<?php echo getModulePath("humanstxt");
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
   
}
</script><form action="<?php echo getModuleAdminSelfPath()?>" method="post">
<p><a href="http://humanstxt.org">Über humans.txt</a><br/></p>
<input type="button" value="Vorlage einfügen" onclick="fillTemplate();">
<p>
<textarea id="text" rows="30" cols="80" style="width:100%" name="text"><?php echo $text;
     ?></textarea>

<p><input type="submit" name="submit" value="Datei Speichern"/></p>
</form>
<?php
     }

?>
