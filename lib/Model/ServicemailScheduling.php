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

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Scheduling used for planning of servicemails.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ServicemailScheduling).
 */
class ServicemailScheduling implements \jsonSerializable
{
    /**
     * Create a new ServicemailScheduling
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Amount of days before/after the event to send the mail.
     *
     * @var int
     */
    public $days;

    /**
     * Send the mail before or after the event.
     *
     * @var string
     */
    public $relative;

    /**
     * The time (HH:MM) at which to send the mail.
     *
     * @var string
     */
    public $time;

    /**
     * Unpack ServicemailScheduling from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ServicemailScheduling
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ServicemailScheduling(array(
            "days" => isset($obj->days) ? $obj->days : null,
            "relative" => isset($obj->relative) ? $obj->relative : null,
            "time" => isset($obj->time) ? $obj->time : null,
        ));
    }

    /**
     * Serialize ServicemailScheduling to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->days)) {
            $result["days"] = intval($this->days);
        }
        if (!is_null($this->relative)) {
            $result["relative"] = strval($this->relative);
        }
        if (!is_null($this->time)) {
            $result["time"] = strval($this->time);
        }

        return $result;
    }
}
