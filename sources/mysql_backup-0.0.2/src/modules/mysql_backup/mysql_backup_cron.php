<?php

error_reporting(0);

include_once getModulePath("mysql_backup") . "mysql_backup_install.php";
mysql_backup_check_install();


if(!function_exists("func_enabled")){
     function func_enabled($func){
         $disabled = explode(',', ini_get('disable_functions'));
         foreach ($disabled as $disableFunction){
             $is_disabled[] = trim($disableFunction);
             }
         if (in_array($func, $is_disabled)){
             $it_is_disabled["m"] = $func . '() has been disabled for security reasons in php.ini';
             $it_is_disabled["s"] = 0;
             }else{
             $it_is_disabled["m"] = $func . '() is allow to use';
             $it_is_disabled["s"] = 1;
             }
         return $it_is_disabled;
         }
    
     }


$current_time = time();
$last_time = getconfig("mysql_backup_last_time");
$difference = $current_time - $last_time;
$backup_interval = 60 * 60 * 24 * getconfig("mysql_backup_every_days");

$config = new config();

$mysql_user = $config -> db_user;
$mysql_password = $config -> db_password;
$mysql_database = $config -> db_database;
$backup_file = path_to_backup_dir() . "dump-" . date('Y-m-d');


$allowed = func_enabled("shell_exec");
$allowed = $allowed["s"] === 1 && !ini_get('safe_mode');


$tmpfile = path_to_backup_dir() . uniqid();
$writable = @file_put_contents($tmpfile,
     "test") !== false;

if($writable){
     @unlink($tmpfile);
     }



if($difference >= $backup_interval and $allowed and $writable){
     // set last backup time to current
    setconfig("mysql_backup_last_time", time());
     @ignore_user_abort(1); // run script in background 
     @set_time_limit(0); // run script forever 
    
     // Save Dump
    shell_exec("mysqldump -u $mysql_user -p$mysql_password --add-drop-table --complete-insert --hex-blob $mysql_database > $backup_file.sql");
     shell_exec("gzip " . $backup_file . ".sql");
    
     }
 // Backup schlägt fehl.
else if($difference >= $backup_interval){
     setconfig("mysql_backup_last_time", time());
    
     // Administrator per E-Mail benachrichtigen
    $email_adress = getconfig("email");
     $subject = "Automatisches MySQL-Backup fehlgeschlagen";
     $text = "Das automatische Backup der MySQL Datenbank auf " . $_SERVER["SERVER_NAME"] .
     " am " . date("d.m.Y") . " ist fehlgeschlagen.\n" .
     "Bitte prüfen Sie, ob der Ordner backup/ existiert und dieser für den Webserver beschreibbar ist (chmod 0755 oder höher).\n" .
     "Der Safe Mode von PHP darf nicht aktiviert sein.\n" .
     "Außerdem muss der PHP-User die Funktion shell_exec() ausführen dürfen.\n\n" .
     "___________\n" .
     "Diese Mail wurde automatisch versandt vom mysql_backup Modul.";
    
     $headers = "From: $email_adress\n" .
     "Content-type: text/plain; charset=UTF-8\n" .
     "X-Mailer: PHP/" . phpversion();
    
     @mail($email_adress, $subject, $text, $headers);
    
    
     }

?>
