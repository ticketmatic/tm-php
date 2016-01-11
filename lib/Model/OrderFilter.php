<?php
/**
 * Copyright (C) 2014-2016 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * @link        http://www.ticketmatic.com/
 */

namespace Ticketmatic\Model;

use Ticketmatic\Json;

/**
 * Used when requesting orders, to filter orders.
 *
 * Specify any of the supported fields to filter the list of orders.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderFilter).
 */
class OrderFilter implements \jsonSerializable
{
    /**
     * Create a new OrderFilter
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Only include orders older than the given timestamp
     *
     * @var \DateTime
     */
    public $createdsince;

    /**
     * Filter orders based on saleschannel
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Filter orders based on customer
     *
     * @var int
     */
    public $customerid;

    /**
     * Only include orders with a given status
     *
     * Possible values:
     *
     * * **21001**: Unconfirmed orders
     *
     * * **21002**: Confirmed orders
     *
     * * **21003**: Archived orders
     *
     * @var int
     */
    public $status;

    /**
     * Unpack OrderFilter from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderFilter
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderFilter(array(
            "createdsince" => isset($obj->createdsince) ? Json::unpackTimestamp($obj->createdsince) : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "status" => isset($obj->status) ? $obj->status : null,
        ));
    }

    /**
     * Serialize OrderFilter to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->createdsince)) {
            $result["createdsince"] = Json::packTimestamp($this->createdsince);
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
        }
        if (!is_null($this->status)) {
            $result["status"] = intval($this->status);
        }

        return $result;
    }
}
