<?php
function faq_render()
{
    $sql = db_query("SELECT * FROM " . tbname("faq") . " ORDER by question ASC");
    if (db_num_rows($sql) <= 0) {
        return "Im Moment sind keine FAQ vorhanden.";
    }
    $html = '<div id="accordion-container"> ';
    
    while ($row = db_fetch_object($sql)) {
        $html .= '<h2 class="accordion-header">' . htmlspecialchars($row->question) . '</h2>';
        $html .= '<div class="accordion-content">' . nl2br(htmlspecialchars($row->answer)) . '</div>';
    }
    
    $html .= "</div>";
    return $html;
}
