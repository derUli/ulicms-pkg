<?php

define("MODULE_ADMIN_HEADLINE", "Link Checker");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "link_checker");

function get_http_response_code($theURL) {
    @$headers = get_headers($theURL);
    if (!$headers) {
        return false;
    }
    return substr($headers[0], 9);
}

function link_checker_admin() {
    ?>

    <p>
        <a href="index.php?action=module_settings&module=link_checker&show=all">Alle</a>
        | <a
            href="index.php?action=module_settings&module=link_checker&show=errors">Nur
            Fehler</a> | <a
            href="index.php?action=module_settings&module=link_checker&show=404">Nicht
            gefunden</a> | <a
            href="index.php?action=module_settings&module=link_checker&show=redirection">Umleitungen</a>
    </p>
    <?php

    flush();
    $query = db_query("SELECT content FROM " . tbname("content"));
    $hasLinks = false;
    while ($row = db_fetch_object($query)) {
        $htmldatei = $row->content;
        $htmldatei = apply_filter($htmldatei, "content");

        preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $htmldatei, $links);
        for ($i = 0; $i < count($links); $i++) {
            if (!empty($links[0][$i])) {
                $status = get_http_response_code($links[0][$i]);

                if (!$status) {
                    // Kein Status weil Fehler bei get_headers
                    $hasLinks = true;
                    echo "<p>" . $links[0][$i] . " [Der Hostname kann nicht aufgelöst werden]</p>";
                } elseif ($_GET["show"] == "all") {
                    $hasLinks = true;
                    echo "<p>" . $links[0][$i] . " [" . htmlspecialchars($status, ENT_QUOTES, "UTF-8") . "]" . "</p>";
                } elseif ($_GET["show"] == "redirection" and startsWith($status, "3")) {
                    $hasLinks = true;
                    echo "<p>" . $links[0][$i] . " [" . htmlspecialchars($status, ENT_QUOTES, "UTF-8") . "]" . "</p>";
                } elseif ($_GET["show"] == "404" and $status === "404 Not Found") {
                    $hasLinks = true;
                    echo "<p>" . $links[0][$i] . " [" . htmlspecialchars($status, ENT_QUOTES, "UTF-8") . "]" . "</p>";
                } elseif ($_GET["show"] == "errors" and (startsWith($status, "4") or startsWith($status, "5"))) {
                    $hasLinks = true;
                    echo "<p>" . $links[0][$i] . " [" . htmlspecialchars($status, ENT_QUOTES, "UTF-8") . "]" . "</p>";
                }

                flush();
            }
        }
    }

    if (!$hasLinks) {
        echo "<p>Keine Links vorhanden.</p>";
    }
}
?>
   
