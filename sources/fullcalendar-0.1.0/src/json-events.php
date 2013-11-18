<?php
 include "init.php";
 $events = array();
 
$c = getconfig("cache_type");
switch($c){
 case "cache_lite":
     @include "Cache/Lite.php";
     $cache_type = "cache_lite";
    
     break;
 case "file": default:
     $cache_type = "file";
     break;
     break;
 }
 
 
 $id = md5($_SERVER['REQUEST_URI']);

 header('Content-Type: application/json; charset=utf8');


 $cached_page_path = buildCacheFilePath($_SERVER['REQUEST_URI']);
 
 if(file_exists($cached_page_path) and !getconfig("cache_disabled") and
 $cache_type == "file"){
 
 
 $cached_content = file_get_contents($cached_page_path);
 $last_modified = filemtime($cached_page_path);



 if($cached_content and (time() - $last_modified < CACHE_PERIOD))
    die($cached_content);
 }
 
 if(file_exists($cached_page_path) and !getconfig("cache_disabled") and
 $cache_type == "cache_lite"){
  $options = array(
'lifeTime' => getconfig("cache_period"));

$Cache_Lite = new Cache_Lite($options);
if ($data = $Cache_Lite -> get($id))
 die($data);


 }
 
 if(!isset($_REQUEST["start"])){
   $_REQUEST["start"] = mktime(0, 0, 0, date("m"), 1, date("y")); 
 }

 if(!isset($_REQUEST["end"])){
  $_REQUEST["end"] = mktime(0, 0, 0, date("m")+1, 0, date("y"));
}
 
 $query = db_query("SELECT * FROM `" . tbname("events") . "` WHERE `start` > ".intval($_REQUEST["start"]). " AND `end` <". intval($_REQUEST["end"]). " ORDER BY id");
 while($row = db_fetch_object($query)){
     $obj = array();
     $obj["id"] = $row -> id;
    
    
     $obj["start"] = date("Y-m-d", $row -> start);
     $obj["end"] = date("Y-m-d", $row -> end);
     $obj["title"] = $row -> title;
    
     if(!empty($row -> url) and $row -> url != "http://")
         $obj["url"] = $row -> url;;
    
     array_push($events, $obj);
    
     }

 $json = json_encode($events);
 
 if(!getconfig("cache_disabled") and $cache_type === "file"){
   $handle = fopen($cached_page_path, "wb");
   fwrite($handle, $json);
   fclose($handle);
 }
 if(!getconfig("cache_disabled") and $cache_type == "cache_lite"){
    $Cache_Lite -> save($json, $id); 
 }
 
 die($json);
 
 


?>