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
 * Additional info when this opt in is set.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ContactOptInInfo).
 */
class ContactOptInInfo implements \jsonSerializable
{
    /**
     * Create a new ContactOptInInfo
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The ip address from which the opt in is set.
     *
     * @var string
     */
    public $ip;

    /**
     * The method by which the status is set
     *
     * @var string
     */
    public $method;

    /**
     * Explanation of why the status was set.
     *
     * @var string
     */
    public $remarks;

    /**
     * ID of the user that has set this opt in.
     *
     * @var int
     */
    public $userid;

    /**
     * Unpack ContactOptInInfo from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ContactOptInInfo
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ContactOptInInfo(array(
            "ip" => isset($obj->ip) ? $obj->ip : null,
            "method" => isset($obj->method) ? $obj->method : null,
            "remarks" => isset($obj->remarks) ? $obj->remarks : null,
            "userid" => isset($obj->userid) ? $obj->userid : null,
        ));
    }

    /**
     * Serialize ContactOptInInfo to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->ip)) {
            $result["ip"] = strval($this->ip);
        }
        if (!is_null($this->method)) {
            $result["method"] = strval($this->method);
        }
        if (!is_null($this->remarks)) {
            $result["remarks"] = strval($this->remarks);
        }
        if (!is_null($this->userid)) {
            $result["userid"] = intval($this->userid);
        }

        return $result;
    }
}
