<?php

namespace Helvetiapps\LiveControls\Utils;

class Arrays
{
    public static function array_get($key, array $array, $default = null) : mixed{
        if(array_key_exists($key, $array)){
            return $array[$key];
        }
        return $default;
    }

    public static function array_remove($key, array &$array){
        $newArray = [];
        foreach($array as $oldKey => $oldValue){
            if($oldKey != $key){
                $newArray[$oldKey] = $oldValue;
            }
        }
        $array = $newArray;
    }

    public static function array_remove_value($value, array &$array){
        $newArray = [];
        foreach($array as $oldValue){
            if($oldValue != $value){
                array_push($newArray, $oldValue);
            }
        }
        $array = $newArray;
    }
}