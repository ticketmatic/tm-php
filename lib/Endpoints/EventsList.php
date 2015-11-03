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

namespace Ticketmatic\Endpoints;

use Ticketmatic\Json;

/**
 * List results
 */
class EventsList
{
    /**
     * Create a new EventsList
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Result data
     *
     * @var \Ticketmatic\Model\Event[] $data
     */
    public $data;

    //region Lookup data

    /**
     * Event locations
     *
     * @var \Ticketmatic\Model\EventLocation[] $locations
     */
    public $locations;

    /**
     * Price types
     *
     * @var \Ticketmatic\Model\PriceType[] $pricetypes
     */
    public $pricetypes;

    /**
     * Seat ranks
     *
     * @var \Ticketmatic\Model\SeatRank[] $seatranks
     */
    public $seatranks;

    //endregion

    /**
     * Unpack EventsList from JSON.
     *
     * @param object $obj
     *
     * @return EventsList
     */
    public static function fromJson($obj) {
        return new EventsList(array(
            "data" => Json::unpackArray("Event", $obj->data),
            "locations" => isset($obj->lookup->locations) ? Json::unpackArray("EventLocation", $obj->lookup->locations) : null,
            "pricetypes" => isset($obj->lookup->pricetypes) ? Json::unpackArray("PriceType", $obj->lookup->pricetypes) : null,
            "seatranks" => isset($obj->lookup->seatranks) ? Json::unpackArray("SeatRank", $obj->lookup->seatranks) : null,
        ));
    }
}
