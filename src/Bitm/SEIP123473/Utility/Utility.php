<?php
namespace App\Bitm\SEIP123473\Utility;

class Utility
{

    public static function d($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }


    public static function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
}