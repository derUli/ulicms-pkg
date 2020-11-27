<?php
class RandomColor
{
    public static function get()
    {
        mt_srand(( double ) microtime() * 1000000);
        $c = '';
        while (strlen($c) < 6) {
            $c .= sprintf("%02X", mt_rand(0, 255));
        }
        return "#" . $c;
    }
}
