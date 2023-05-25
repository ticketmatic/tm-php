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
 * Request data used to add tickets (api/orders/addtickets) to an order
 * (api/types/Order). The amount of tickets that can be added is limited to 50 per
 * call.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/AddTickets).
 */
class AddTickets implements \jsonSerializable
{
    /**
     * Create a new AddTickets
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * If this is set adding the tickets will only succeed if all tickets can be placed
     * on a single row
     *
     * @var bool
     */
    public $onlysinglerow;

    /**
     * Ticket information
     *
     * @var \Ticketmatic\Model\CreateTicket[]
     */
    public $tickets;

    /**
     * Unpack AddTickets from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\AddTickets
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new AddTickets(array(
            "onlysinglerow" => isset($obj->onlysinglerow) ? $obj->onlysinglerow : null,
            "tickets" => isset($obj->tickets) ? Json::unpackArray("CreateTicket", $obj->tickets) : null,
        ));
    }

    /**
     * Serialize AddTickets to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->onlysinglerow)) {
            $result["onlysinglerow"] = (bool)$this->onlysinglerow;
        }
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
        }

        return $result;
    }
}
