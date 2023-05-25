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
 * Information about the sales period for a specific sales channel
 * (api/types/SalesChannel) in an event (api/types/Event).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventSalesChannel).
 */
class EventSalesChannel implements \jsonSerializable
{
    /**
     * Create a new EventSalesChannel
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Event ID
     *
     * @var int
     */
    public $eventid;

    /**
     * Whether or not this sales channels has a waiting list for this event
     *
     * @var bool
     */
    public $haswaitinglist;

    /**
     * Whether or not this sales channel is active for this event
     *
     * @var bool
     */
    public $isactive;

    /**
     * When the sales end
     *
     * @var \DateTime
     */
    public $saleendts;

    /**
     * Sales channel ID
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * When the sales start
     *
     * @var \DateTime
     */
    public $salestartts;

    /**
     * Unpack EventSalesChannel from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventSalesChannel
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventSalesChannel(array(
            "eventid" => isset($obj->eventid) ? $obj->eventid : null,
            "haswaitinglist" => isset($obj->haswaitinglist) ? $obj->haswaitinglist : null,
            "isactive" => isset($obj->isactive) ? $obj->isactive : null,
            "saleendts" => isset($obj->saleendts) ? Json::unpackTimestamp($obj->saleendts) : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "salestartts" => isset($obj->salestartts) ? Json::unpackTimestamp($obj->salestartts) : null,
        ));
    }

    /**
     * Serialize EventSalesChannel to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->eventid)) {
            $result["eventid"] = intval($this->eventid);
        }
        if (!is_null($this->haswaitinglist)) {
            $result["haswaitinglist"] = (bool)$this->haswaitinglist;
        }
        if (!is_null($this->isactive)) {
            $result["isactive"] = (bool)$this->isactive;
        }
        if (!is_null($this->saleendts)) {
            $result["saleendts"] = Json::packTimestamp($this->saleendts);
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->salestartts)) {
            $result["salestartts"] = Json::packTimestamp($this->salestartts);
        }

        return $result;
    }
}
