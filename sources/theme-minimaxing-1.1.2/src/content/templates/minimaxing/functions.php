<?php

class Minimaxing_Theme {

    public static function get_menu($name = "top", $parent_id = null, $recursive = true, $order = "position") {
        $html = "";
        $name = db_escape($name);
        $language = $_SESSION ["language"];
        $sql = "SELECT id, slug, access, link_url, title, alternate_title, menu_image, target FROM " . tbname("content") . " WHERE menu='$name' AND language = '$language' AND active = 1 AND `deleted_at` IS NULL AND parent_id ";

        if (is_null($parent_id)) {
            $sql .= " IS NULL ";
        } else {
            $sql .= " = " . intval($parent_id) . " ";
        }
        $sql .= " ORDER by " . $order;
        $query = db_query($sql);

        if (db_num_rows($query) == 0) {
            return $html;
        }

        if (is_null($parent_id)) {
            $html .= '<nav id="nav">';
        } else {
            $containsCurrentItem = parent_item_contains_current_page($parent_id);

            $classes = "sub_menu";

            if ($containsCurrentItem) {
                $classes .= " contains-current-page";
            }
            $html .= '<nav id="nav">';
        }

        while ($row = db_fetch_object($query)) {
            if (checkAccess($row->access)) {
                $containsCurrentItem = parent_item_contains_current_page($row->id);

                $additional_classes = " menu-link-to-" . $row->id . " ";
                if ($containsCurrentItem)
                    $additional_classes .= "current-page-item ";

                if (!empty($row->alternate_title))
                    $title = $row->alternate_title;
                else
                    $title = $row->title;
                if (get_slug() != $row->slug) {
                    $html .= "<a href='" . buildSEOUrl($row->slug, $row->link_url) . "' target='" . $row->target . "' class='" . trim($additional_classes) . "'>";
                } else {
                    $html .= "<a class='current-page-item" . rtrim($additional_classes) . "' href='" . buildSEOUrl($row->slug, $row->link_url) . "' target='" . $row->target . "'>";
                }
                if (!is_null($row->menu_image) and ! empty($row->menu_image)) {
                    $html .= '<img src="' . $row->menu_image . '" alt="' . htmlentities($row->title, ENT_QUOTES, "UTF-8") . '"/>';
                } else {
                    $html .= htmlentities($row->title, ENT_QUOTES, "UTF-8");
                }
                $html .= "</a>\n";

                if ($recursive) {
                    $html .= get_menu($name, $row->id, true, $order);
                }
            }
        }
        $html .= "</nav>";
        return $html;
    }

    public static function menu() {
        echo self::get_menu();
    }

}
