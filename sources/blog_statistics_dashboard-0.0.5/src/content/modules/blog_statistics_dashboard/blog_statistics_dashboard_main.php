<?php
function blog_statistics_dashboard_render()
{
    $mainFile = getModuleMainFilePath("blog");
    if (file_exists($mainFile)) {
        include $mainFile;
        return blog_render();
    }
    
    return "<p class=\"ulicms-error\">$mainFile fehlt!</p>";
}
