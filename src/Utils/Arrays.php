<?php

namespace Helvetiapps\LiveControls\Utils;

class Arrays
{
    public static function array_get($key, array $array, $default = null){
        if(array_key_exists($key, $array)){
            return $array[$key];
        }
        return $default;
    }
}