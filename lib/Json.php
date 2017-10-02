<?php
/**
 * Copyright (C) 2014-2017 by Ticketmatic BVBA <developers@ticketmatic.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license     MIT X11 http://opensource.org/licenses/MIT
 * @author      Ticketmatic BVBA <developers@ticketmatic.com>
 * @copyright   Ticketmatic BVBA
 * @link        https://www.ticketmatic.com/
 */

namespace Ticketmatic;

/**
 * JSON utilities
 */
class Json {
    private static $tz;

    /**
     * Unpack an array of objects to a typed array.
     *
     * @param string $type
     * @param array $arr
     */
    public static function unpackArray($type, $arr) {
        $target = "\\Ticketmatic\\Model\\$type";
        $result = array();
        foreach ($arr as $key => $obj) {
            $result[$key] = $target::fromJson($obj);
        }
        return $result;
    }

    /**
     * Unpack a timestamp
     *
     * @param string $ts
     */
    public static function unpackTimestamp($ts) {
        if (self::$tz == null) {
            self::$tz = new \DateTimeZone(date_default_timezone_get());
        }

        $dt = new \DateTime($ts);
        $dt->setTimeZone(self::$tz); // Convert to local time
        return $dt;
    }

    /**
     * Serialize a timestamp back to ISO8601.
     *
     * @param \DateTime $time
     */
    public static function packTimestamp($time) {
        if ($time instanceof \DateTime) {
            return $time->format(\DateTime::ISO8601);
        }
        return $time;
    }
}
