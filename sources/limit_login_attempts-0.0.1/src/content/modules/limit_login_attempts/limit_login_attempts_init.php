<?php
$ip = $_SERVER["REMOTE_ADDR"];

// Maximale Anzahl der Loginversuche
$max_login_attempts = getconfig("max_login_attempts");
if(!$max_login_attempts)
     $max_login_attempts = 5;


$ip_blocking_duration = getconfig("ip_blocking_duration");

// 3 Stunden blocken, sofern nicht anders definiert
if(!$ip_blocking_duration)
     $ip_blocking_duration = 3;


$ip_blocking_duration = $ip_blocking_duration * (60 * 60);

db_query("DELETE FROM " . tbname("failed_logins") . " WHERE " . time() . " -  `time` > $ip_blocking_duration");

$query = db_query("SELECT * FROM " . tbname("failed_logins") .
     " WHERE ip='$ip'");

if(db_num_rows($query) >= $max_login_attempts){
     die("<p>Sie haben die maximale Anzahl an erfolglosen Login-Versuchen &uuml;berschritten.<br/>Ihre IP-Adresse wurde gesperrt!</p>");
     }
?>