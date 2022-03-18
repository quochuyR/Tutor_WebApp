<?php

namespace Helpers;

class Convert{
    public static function ArrayToObject($array){
        return json_decode(json_encode($array), false);
    }

    public static function ObjectToArray($object){
        return json_decode(json_encode($object), true);
    }
}