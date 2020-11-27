<?php
if (containsModule(get_slug(), "kundenbereich")) {
    if (! is_logged_in()) {
        $url = "admin/?go=" . urlencode(getCurrentURL());
        header("Location: " . $url);
        exit();
    }
    
    if (isset($_GET["get"])) {
        $get = intval($_GET["get"]);
        $query = db_query("SELECT filename, content FROM `" . tbname("shared_files") . "` WHERE `user_id` = " . intval($_SESSION["login_id"]) . " AND id = " . $get);
        if (db_num_rows($query) > 0) {
            $data = db_fetch_assoc($query);
            $content = base64_decode($data["content"]);
            $filesize = mb_strlen($content, '8bit');
            
            @set_time_limit(0); // Kein Zeitlimit
            header("HTTP/1.0 200 OK");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $data["filename"]);
            header("Cache-Control: public");
            header("Content-length: " . $filesize); // tells file size
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $content;
            exit();
        } else {
            TextResult("Diese Datei ist nicht vorhanden, oder sie ist nicht für Sie freigegeben.", 404);
        }
    }
}
