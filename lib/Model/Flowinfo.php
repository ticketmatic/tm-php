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
 * Info about a finished flow
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Flowinfo).
 */
class Flowinfo implements \jsonSerializable
{
    /**
     * Create a new Flowinfo
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Contact id
     *
     * @var int
     */
    public $contactid;

    /**
     * Order active in the flow
     *
     * @var \Ticketmatic\Model\Order
     */
    public $order;

    /**
     * Reason the user was redirected
     *
     * @var string
     */
    public $reason;

    /**
     * Unpack Flowinfo from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Flowinfo
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Flowinfo(array(
            "contactid" => isset($obj->contactid) ? $obj->contactid : null,
            "order" => isset($obj->order) ? Order::fromJson($obj->order) : null,
            "reason" => isset($obj->reason) ? $obj->reason : null,
        ));
    }

    /**
     * Serialize Flowinfo to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->contactid)) {
            $result["contactid"] = intval($this->contactid);
        }
        if (!is_null($this->order)) {
            $result["order"] = $this->order;
        }
        if (!is_null($this->reason)) {
            $result["reason"] = strval($this->reason);
        }

        return $result;
    }
}
