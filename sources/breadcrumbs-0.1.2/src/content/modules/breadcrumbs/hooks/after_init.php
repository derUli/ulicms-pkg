<?php

if (!function_exists("get_breadcrumbs")) {

    function get_breadcrumbs() {
        if (!is_200()) {
            return "";
        }
        $page = get_page();
        $parent = $page ["parent_id"];
        $parent_name = getPageSlugByID($parent);
        $html = "<a href=\"" . buildSEOUrl($page ["slug"], $page ["link_url"]) . "\" class=\"crumb-active-page\">" . htmlspecialchars($page ["title"]) . "</a>";
        while ($parent != null) {
            $page = get_page($parent_name);
            $parent = $page ["parent_id"];
            $parent_name = getPageSlugByID($parent);
            $html = "<a href=\"" . buildSEOUrl($page ["slug"], $page ["link_url"]) . "\" class=\"crumb-page\">" . htmlspecialchars($page ["title"]) . "</a>" . " &gt; " . $html;
        }

        $html = "<a href=\"" . buildSEOUrl(get_frontpage()) . "\" class=\"crumb-frontpage\">" . get_translation("frontpage") . "</a>" . " &gt; " . $html;

        $html = '<div class="breadcrumb_nav">' . $html . "</div>";
        return $html;
    }

}

if (!function_exists("breadcrumbs")) {

    function breadcrumbs() {
        echo get_breadcrumbs();
    }

}
