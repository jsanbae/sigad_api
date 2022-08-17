<?php

namespace Jsanbae\SigadAPI\Utils;

class Data
{
    public static function trim(array $data) {
        return array_map(function($value) {
            if (is_array($value)) return self::trim($value);
            if (is_object($value)) return $value;
            return trim($value);
        }, $data);
    }
}
