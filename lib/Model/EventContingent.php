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
 * Information about a contingent for an event (api/types/Event).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventContingent).
 */
class EventContingent implements \jsonSerializable
{
    /**
     * Create a new EventContingent
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Contingent ID
     *
     * @var int
     */
    public $id;

    /**
     * Name of the contingent
     *
     * @var string
     */
    public $name;

    /**
     * Number of tickets in the contingent
     *
     * @var int
     */
    public $amount;

    /**
     * Event ID
     *
     * @var int
     */
    public $eventid;

    /**
     * Event specific prices in addition to the prices defined in the field
     * `pricelistid`. Prices from the pricelist and the event specific prices are
     * combined in one pricelist. The optional position attribute defines where the
     * event specific prices will be positioned in the resulting pricelist
     *
     * @var \Ticketmatic\Model\PricelistPrices
     */
    public $eventspecificprices;

    /**
     * Locked tickets for the contingent
     *
     * @var \Ticketmatic\Model\EventContingentLock[]
     */
    public $locks;

    /**
     * Price list ID for this contingent
     *
     * @var int
     */
    public $pricelistid;

    /**
     * Whether the barcodes for the tickets in this contingent were imported (true),
     * or were generated internally (false)
     *
     * @var bool
     */
    public $withimportedbarcodes;

    /**
     * Unpack EventContingent from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventContingent
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new EventContingent(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "eventid" => isset($obj->eventid) ? $obj->eventid : null,
            "eventspecificprices" => isset($obj->eventspecificprices) ? PricelistPrices::fromJson($obj->eventspecificprices) : null,
            "locks" => isset($obj->locks) ? Json::unpackArray("EventContingentLock", $obj->locks) : null,
            "pricelistid" => isset($obj->pricelistid) ? $obj->pricelistid : null,
            "withimportedbarcodes" => isset($obj->withimportedbarcodes) ? $obj->withimportedbarcodes : null,
        ));
    }

    /**
     * Serialize EventContingent to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->amount)) {
            $result["amount"] = intval($this->amount);
        }
        if (!is_null($this->eventid)) {
            $result["eventid"] = intval($this->eventid);
        }
        if (!is_null($this->eventspecificprices)) {
            $result["eventspecificprices"] = $this->eventspecificprices;
        }
        if (!is_null($this->locks)) {
            $result["locks"] = $this->locks;
        }
        if (!is_null($this->pricelistid)) {
            $result["pricelistid"] = intval($this->pricelistid);
        }
        if (!is_null($this->withimportedbarcodes)) {
            $result["withimportedbarcodes"] = (bool)$this->withimportedbarcodes;
        }

        return $result;
    }
}
