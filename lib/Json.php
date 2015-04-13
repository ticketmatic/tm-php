<?php
namespace Ticketmatic;

class Json {
    public static function unpackArray($type, $arr) {
        $result = array();
        $target = "\\Ticketmatic\\Model\\$type";
        foreach ($arr as $key => $obj) {
            $result[$key] = $target::fromJson($obj);
        }
        return $result;
    }

    public static function unpackTimestamp($ts) {
        return new \DateTime($ts);
    }

    public static function packTimestamp($time) {
        return $time->format(\DateTime::ISO8601);
    }
}
