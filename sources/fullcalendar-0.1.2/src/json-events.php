<?php
 include "init.php";
 include "templating.php";
 $events = array();

 header('Content-Type: application/json; charset=utf8');

 if(!isset($_REQUEST["start"])){
    $_REQUEST["start"] = mktime(0, 0, 0, date("m"), 1, date("y"));
 }

 if(!isset($_REQUEST["end"])){
    $_REQUEST["end"] = mktime(0, 0, 0, date("m") + 1, 0, date("y"));
}

 $query = db_query("SELECT * FROM `" . tbname("events") . "` WHERE `start` >= " . intval($_REQUEST["start"]) . " AND `end` <" . intval($_REQUEST["end"]) . " ORDER BY id");
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
 die($json);
