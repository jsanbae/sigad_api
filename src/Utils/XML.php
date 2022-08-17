<?php

namespace Jsanbae\SigadAPI\Utils;

class XML
{
    static public function loadXmlStringAsArray($xmlString): array
    {
        $array = (array) @simplexml_load_string($xmlString);
        if(!$array){
            $array = (array) @json_decode($xmlString, true, 512, JSON_THROW_ON_ERROR);
        } else{
            $array = (array)@json_decode(json_encode($array, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        return $array;
    }
}
