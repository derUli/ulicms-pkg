<?php
function fullcalendar_dashboard_render()
{
    $mainFile = getModuleMainFilePath("fullcalendar");
    if (file_exists($mainFile)) {
        include $mainFile;
        return blog_render();
    }
    
    return "<p class=\"ulicms-error\">$mainFile fehlt!</p>";
}
