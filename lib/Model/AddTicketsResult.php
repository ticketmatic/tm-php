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
 * Result when adding tickets
 * (https://apps.ticketmatic.com/#/knowledgebase/api/orders/addtickets) to an order
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AddTicketsResult).
 */
class AddTicketsResult implements \jsonSerializable
{
    /**
     * Create a new AddTicketsResult
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Number of tickets added
     *
     * @var int
     */
    public $nbrofaddedtickets;

    /**
     * The modified order
     *
     * @var \Ticketmatic\Model\Order
     */
    public $order;

    /**
     * Unpack AddTicketsResult from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AddTicketsResult
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AddTicketsResult(array(
            "nbrofaddedtickets" => isset($obj->nbrofaddedtickets) ? $obj->nbrofaddedtickets : null,
            "order" => isset($obj->order) ? Order::fromJson($obj->order) : null,
        ));
    }

    /**
     * Serialize AddTicketsResult to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->nbrofaddedtickets)) {
            $result["nbrofaddedtickets"] = intval($this->nbrofaddedtickets);
        }
        if (!is_null($this->order)) {
            $result["order"] = $this->order;
        }

        return $result;
    }
}
