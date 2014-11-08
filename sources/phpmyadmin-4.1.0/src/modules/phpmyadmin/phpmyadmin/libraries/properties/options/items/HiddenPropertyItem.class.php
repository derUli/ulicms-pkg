<?php
/**
 * vim: set expandtab sw=4 ts=4 sts=4:
 */
/**
 * Holds the HiddenPropertyItem class
 * 
 * @package PhpMyAdmin
 */
if (! defined('PHPMYADMIN')){
     exit;
     }

/**
 * This class extends the OptionsPropertyOneItem class
 */
require_once 'libraries/properties/options/OptionsPropertyOneItem.class.php';

/**
 * Single property item class of type hidden
 * 
 * @package PhpMyAdmin
 */
class HiddenPropertyItem extends OptionsPropertyOneItem
{
    /**
     * Returns the property item type of either an instance of
     *      - OptionsPropertyOneItem ( f.e. "bool", "text", "radio", etc ) or
     *      - OptionsPropertyGroup   ( "root", "main" or "subgroup" )
     *      - PluginPropertyItem     ( "export", "import", "transformations" )
     * 
     * @return string 
     */
     public function getItemType()
    {
         return "hidden";
         }
     }
?>