<?php
/**
 * Copyright (C) 2014-2015 by Ticketmatic BVBA <developers@ticketmatic.com>
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
 * Information about the price for a pricetype for the specific sales channel for
 * an event.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventPricesSaleschannel).
 */
class EventPricesSaleschannel implements \jsonSerializable
{
    /**
     * Create a new EventPricesSaleschannel
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Saleschannel ID
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Tickettypeprice ID
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * The actual price
     *
     * @var float
     */
    public $price;

    /**
     * The actual servicecharge
     *
     * @var float
     */
    public $servicecharge;

    /**
     * The costs associated with this price
     *
     * @var \Ticketmatic\Model\EventPricesCost[]
     */
    public $costs;

    /**
     * Unpack EventPricesSaleschannel from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventPricesSaleschannel
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventPricesSaleschannel(array(
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "servicecharge" => isset($obj->servicecharge) ? $obj->servicecharge : null,
            "costs" => isset($obj->costs) ? Json::unpackArray("EventPricesCost", $obj->costs) : null,
        ));
    }

    /**
     * Serialize EventPricesSaleschannel to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->servicecharge)) {
            $result["servicecharge"] = floatval($this->servicecharge);
        }
        if (!is_null($this->costs)) {
            $result["costs"] = $this->costs;
        }

        return $result;
    }
}
