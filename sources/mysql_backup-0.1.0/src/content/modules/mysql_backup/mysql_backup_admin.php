<?php
define("MODULE_ADMIN_HEADLINE", "Automatische Sicherung der MySQL-Datenbank");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "mysql_backup");

include_once getModulePath("mysql_backup", true) . "mysql_backup_install.php";
mysql_backup_check_install();

function mysql_backup_admin()
{
    
    // Geänderte Optionen in der Datenbank eintragen
    if (isset($_POST["mysql_backup_every_days"])) {
        setconfig("mysql_backup_every_days", intval($_POST["mysql_backup_every_days"]));
    }
    
    if (isset($_POST["backup_now"])) {
        setconfig("mysql_backup_last_time", 0);
        include_once getModulePath("mysql_backup", true) . 'mysql_backup_cron.php';
        setconfig("mysql_backup_last_time", time());
        echo "<span style='color:green;'>" . "Die Sicherung wurde durchgeführt!" . "</span>" . "<br/>";
    }
    
    if (! isset($_POST["backup_now"]) and $_SERVER["REQUEST_METHOD"] and $_POST["backup_file"] == "-") {
        echo "<span style='color:green;'>" . "Die Einstellungen wurde gespeichert!" . "</span>" . "<br/>";
    }
    
    // get current options
    $mysql_backup_last_time = getconfig("mysql_backup_last_time");
    $mysql_backup_every_days = getconfig("mysql_backup_every_days");
    
    $backup_folder = ULICMS_ROOT . "/backup";
    
    $backup_files = array();
    
    $backups = scandir($backup_folder);
    for ($i = 0; $i < count($backups); $i ++) {
        if (endsWith($backups[$i], ".gz")) {
            array_push($backup_files, basename($backups[$i]));
        }
    }
    $reset = false;
    
    if (! empty($_POST["backup_file"]) and $_POST["backup_file"] != "-") {
        $file = $backup_folder . "/" . basename($_POST["backup_file"]);
        
        if (file_exists($file)) {
            
            $dumpfile = strstr($file, '.gz', true);
            
            $extract_cmd = "gzip -d \"$file\"";
            shell_exec($extract_cmd);
            
            @ignore_user_abort(1); // run script in background
            @set_time_limit(0); // run script forever
            
            $cfg = new config();
            $command = "mysql -u " . $cfg->db_user . " -p" . $cfg->db_password . " -h " . $cfg->db_server . " " . $cfg->db_database . " < " . '"' . $dumpfile . '"';
            
            shell_exec($command);
            
            $compress_cmd = "gzip \"" . $dumpfile . "\"";
            shell_exec($compress_cmd);
            unlink($dumpfile);
            $reset = true;
        }
    }
    
    ?>
<?php
    
    if ($reset) {
        echo "<p style='color:green;'>" . "Das Backup wurde wieder hergestellt.</p>";
    }
    ?>
<form method="post" action="<?php echo getModuleAdminSelfPath()?>">
<?php
    
    csrf_token_html();
    ?>
<table style="border: 0px">
		<tr>
			<td><strong>Die Datenbank alle X Tage sichern</strong></td>
			<td><input name="mysql_backup_every_days" type="number" step="any"
				value="<?php
    echo $mysql_backup_every_days;
    ?>" min="1"
				max="365"></td>
		</tr>
		<tr>
			<td><strong>Letzte Sicherung durchgeführt am:
					&nbsp;&nbsp;&nbsp;&nbsp; </strong></td>
			<td><?php
    
    echo date("d.m.Y", $mysql_backup_last_time);
    ?>

		
		
		
		
		
		
		
		
		
		</tr>
		<tr>
			<td><strong>Existierende Backups</strong></td>
			<td><select name="backup_file" size=1>

					<option value="-" selected="selected"
						name="Backup wiederherstellen">Backup Wiederherstellen</option>
<?php
    
    for ($i = 0; $i < count($backup_files); $i ++) {
        
        echo '<option value="' . $backup_files[$i] . '">' . $backup_files[$i] . "</option>";
    }
    ?>

</select></td>
		
		
		<tr>
			<td><strong>Jetzt eine Sicherung durchführen:</td>
			<td><input type="checkbox" name="backup_now" value="backup_now" /></td>
		</tr>
	</table>
	<button type="submit" name="submit" class="btn btn-danger">Einstellungen
		speichern</button>
</form>



<?php }
?>
