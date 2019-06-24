<?php
namespace App\Helpers;

class GeneralHelper
{
    public static function toBool($var) {
        if (!is_string($var)) return (bool) $var;
        switch (strtolower($var)) {
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
                return true;
            default:
                return false;
        }
    }
}
