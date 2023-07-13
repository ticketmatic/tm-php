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
 * Required data for creating an order (api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CreateOrder).
 */
class CreateOrder implements \jsonSerializable
{
    /**
     * Create a new CreateOrder
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Event IDs that might end up in this order, used to hint the rate limiter
     * (api/ratelimiting) of what might come.
     *
     * @var int[]
     */
    public $events;

    /**
     * Product IDs that might end up in this order, used to hint the rate limiter
     * (api/ratelimiting) of what might come.
     *
     * @var int[]
     */
    public $products;

    /**
     * Sales channel in which this order is created
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Unpack CreateOrder from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CreateOrder
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new CreateOrder(array(
            "events" => isset($obj->events) ? $obj->events : null,
            "products" => isset($obj->products) ? $obj->products : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
        ));
    }

    /**
     * Serialize CreateOrder to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->events)) {
            $result["events"] = $this->events;
        }
        if (!is_null($this->products)) {
            $result["products"] = $this->products;
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }

        return $result;
    }
}
