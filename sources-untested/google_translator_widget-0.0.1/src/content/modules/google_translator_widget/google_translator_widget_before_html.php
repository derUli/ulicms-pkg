<?php

function get_google_translator_widget() {
    $file = getModulePath("google_translator_widget") . "code.html";
    $content = file_get_contents($file);
    $content = str_replace("%language%", getCurrentLanguage(), $content);
    return $content;
}

function google_translator_widget() {
    echo get_google_translator_widget();
}
