<?php

class Sites
{
    public static function getAllSites()
    {
        return Database::pQuery("select *, CONCAT(protocol, domain, path) as url from " . tbname("umanage_sites") . " where enabled = ? order by domain", array(
                    1
        ));
    }

    public static function getSiteByID($id)
    {
        return Database::pQuery("select *, CONCAT(protocol, domain, path) as url from " . tbname("umanage_sites") . " where enabled = ? and id = ?  order by domain", array(
                    1,
                    $id
        ));
    }
}
