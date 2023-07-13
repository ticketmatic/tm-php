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
 * App optin
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Appoptin).
 */
class Appoptin implements \jsonSerializable
{
    /**
     * Create a new Appoptin
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * IP address
     *
     * @var string
     */
    public $ip;

    /**
     * The message shown for the optin
     *
     * @var string
     */
    public $message;

    /**
     * Method used for optin
     *
     * @var string
     */
    public $method;

    /**
     * The status of the optin
     *
     * @var bool
     */
    public $status;

    /**
     * Created timestamp
     *
     * @var string
     */
    public $ts;

    /**
     * Unpack Appoptin from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Appoptin
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Appoptin(array(
            "ip" => isset($obj->ip) ? $obj->ip : null,
            "message" => isset($obj->message) ? $obj->message : null,
            "method" => isset($obj->method) ? $obj->method : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "ts" => isset($obj->ts) ? $obj->ts : null,
        ));
    }

    /**
     * Serialize Appoptin to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->ip)) {
            $result["ip"] = strval($this->ip);
        }
        if (!is_null($this->message)) {
            $result["message"] = strval($this->message);
        }
        if (!is_null($this->method)) {
            $result["method"] = strval($this->method);
        }
        if (!is_null($this->status)) {
            $result["status"] = (bool)$this->status;
        }
        if (!is_null($this->ts)) {
            $result["ts"] = strval($this->ts);
        }

        return $result;
    }
}
