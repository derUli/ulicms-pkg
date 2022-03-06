<?php
define("MODULE_ADMIN_HEADLINE", "XML Sitemap");
define("MODULE_ADMIN_REQUIRED_PERMISSION", "xml_sitemap");

function xmlspecialchars($text) {
    return str_replace('&#039;', '&apos;', htmlspecialchars($text, ENT_QUOTES));
}

function getBaseURL($language = null) {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    $dirname = str_replace("admin", "", dirname($_SERVER["REQUEST_URI"]));
    $dirname = str_replace("\\", "/", $dirname);
    $dirname = trim($dirname, "/");
    if ($dirname != "") {
        $dirname = "/" . $dirname . "/";
    } else {
        $dirname = "/";
    }
    if (is_null($language)) {
        $domain = $_SERVER["HTTP_HOST"];
    } else {
        $domain = getDomainByLanguage($language);
        if (!$domain) {
            $domain = $_SERVER["HTTP_HOST"];
        }
    }
    if ($_SERVER["SERVER_PORT"] != "80" and $_SERVER["SERVER_PORT"] != "443") {
        $pageURL .= $domain . ":" . $_SERVER["SERVER_PORT"] . $dirname;
    } else {
        $pageURL .= $domain . $dirname;
    }
    return $pageURL;
}

function generate_sitemap() {
    @set_time_limit(0);
    @ini_set('max_execution_time', 0);

    $xml_string = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';
    $query_pages = db_query("SELECT * FROM " . tbname("content") . " WHERE active = 1 AND `deleted_at` IS NULL and `type` <> 'node' and `type` <> 'snippet' and `type` <> 'link' ORDER by lastmodified DESC");
    while ($row = db_fetch_object($query_pages)) {
        if (!($row->link_url && startsWith($row->link_url, "#"))) {
            $xml_string .= "<url>\r\n";
            $xml_string .= "\t<loc>" . xmlspecialchars(getBaseURL($row->language) . $row->slug . ".html") . "</loc>\r\n";
            $xml_string .= "\t<lastmod>" . date("Y-m-d", $row->lastmodified) . "</lastmod>\r\n";
            $xml_string .= "</url>\r\n\r\n";

            if (containsModule($row->slug, "blog")) {
                $query_blog = db_query("SELECT * FROM " . tbname("blog") . " WHERE entry_enabled = 1 AND language='" . $row->language . "' ORDER by datum DESC");
                while ($row2 = db_fetch_object($query_blog)) {
                    $xml_string .= "<url>\r\n";
                    $xml_string .= "\t<loc>" . xmlspecialchars(getBaseURL($row->language) . $row->slug . ".html?single=" . $row2->seo_shortname) . "</loc>\r\n";
                    $xml_string .= "\t<lastmod>" . date("Y-m-d", $row2->datum) . "</lastmod>\r\n";
                    $xml_string .= "</url>\r\n\r\n";
                }
            }
        }
    }
    $xml_string = apply_filter($xml_string, "xml_sitemap_urlset");

    $xml_string .= "</urlset>";
    $xml_string = str_replace("\r\n", "\n", $xml_string);
    $xml_string = str_replace("\r", "\n", $xml_string);
    $xml_string = str_replace("\n", "\r\n", $xml_string);

    $xml_file = ULICMS_ROOT . "/sitemap.xml";

    $url = "../sitemap.xml";

    $handle = @fopen($xml_file, "w");
    if ($handle) {
        fwrite($handle, $xml_string);
        fclose($handle);

        $xml_sitemap_url = Settings::get("xml_sitemap_url");
        if ($xml_sitemap_url) {
            file_get_contents_wrapper("https://google.com/ping?sitemap=" . urlencode($xml_sitemap_url), true);
        }

        translate("GENERATE_XML_SITEMAP_SUCCESS", array(
            "%url%" => $url
        ));
    } else {
        translate("GENERATE_XML_SITEMAP_FAILED");
        echo "<textarea cols=70 rows=20>";
        echo htmlspecialchars($xml_string);
        echo "</textarea><br/><br/>";
    }
}

// Konfiguration checken
$send_comments_via_email = getconfig("blog_send_comments_via_email") == "yes";

function xml_sitemap_admin() {
    if (isset($_POST["submit"])) {
        generate_sitemap();
    }
    ?>
    <form action="<?php echo getModuleAdminSelfPath() ?>" method="post">
        <?php csrf_token_html(); ?>
        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-sitemap"></i> <?php translate("generate_xml_sitemap"); ?></button>
    </form>
    <?php
}
