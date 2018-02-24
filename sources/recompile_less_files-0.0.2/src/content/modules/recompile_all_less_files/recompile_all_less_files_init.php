<?php

function recompile_all_less_files()
{
    require_once getModulePath("lessphp", true) . "lessc.inc.php";
    
    $all_files = find_all_files(ULICMS_ROOT);
    $less_files = array();
    foreach ($all_files as $file) {
        if (endsWith($file, ".less") and (is_file($file))) {
            $less_files[] = $file;
        }
    }
    
    // var_dump($less_files);
    $less = new lessc();
    foreach ($less_files as $input_file) {
        $path_parts = pathinfo($input_file);
        $output_file = $path_parts['dirname'] . "/" . $path_parts['filename'] . ".css";
        $less->setImportDir(array(
            $path_parts['dirname']
        ));
        try {
            $less->checkedCompile($input_file, $output_file);
        } catch (exception $e) {
            // @TODO Log exception
        }
    }
}