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

class Event implements \jsonSerializable
{
    /**
     * Create a new Event
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
    public $id;

    /**
     * Event name
     *
     * @var string
     */
    public $name;

    /**
     * Event subtitle
     *
     * @var string
     */
    public $subtitle;

    /**
     * Event subtitle (2)
     *
     * @var string
     */
    public $subtitle2;

    /**
     * Small description that will be shown on the sales pages of this event
     *
     * @var string
     */
    public $webremark;

    /**
     * Event start time
     *
     * @var \DateTime
     */
    public $startts;

    /**
     * Time of start of sales.
     *
     * Used for all sales channels for which no specific sales period has been defined.
     *
     * @var \DateTime
     */
    public $salestartts;

    /**
     * Time of end of sales.
     *
     * Used for all sales channels for which no specific sales period has been defined.
     *
     * @var \DateTime
     */
    public $saleendts;

    /**
     * Event publish time
     *
     * @var \DateTime
     */
    public $publishedts;

    /**
     * Event end time
     *
     * @var \DateTime
     */
    public $endts;

    /**
     * Event code.
     *
     * Used as a unique identifier in web sales.
     *
     * @var string
     */
    public $code;

    /**
     * External event code.
     *
     * This field is typically set when importing data from other systems.
     *
     * @var string
     */
    public $externalcode;

    /**
     * Production ID
     *
     * @var int
     */
    public $productionid;

    /**
     * Event location ID
     *
     * See event locations
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_events_eventlocations)
     * for more info.
     *
     * @var int
     */
    public $locationid;

    /**
     * Event location name
     *
     * Automatically derived using `locationid`.
     *
     * @var string
     */
    public $locationname;

    /**
     * Seating plan ID
     *
     * Only set for events with fixed seats. See seating plans
     * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Seatingplan) for more
     * info.
     *
     * @var int
     */
    public $seatingplanid;

    /**
     * Price list ID for fixed seats.
     *
     * Only set for events with fixed seats. See price lists
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_pricelists)
     * for more info.
     *
     * @var int
     */
    public $seatingplanpricelistid;

    /**
     * @var object
     */
    public $seatingplaneventspecificprices;

    /**
     * @var object
     */
    public $seatingplancontingents;

    /**
     * @var object
     */
    public $contingents;

    /**
     * Price availability ID
     *
     * Determines which price types are available for this event. See price
     * availabilities
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_priceavailabilities)
     * for more info.
     *
     * @var int
     */
    public $priceavailabilityid;

    /**
     * Ticket fee ID
     *
     * Determines which ticket fee rules are used for this event. See ticket fees
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_ticketfees)
     * for more info.
     *
     * @var int
     */
    public $ticketfeeid;

    /**
     * Revenue split ID
     *
     * Determines which revenue split rules are used for this event. See revenue splits
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_pricing_revenuesplits)
     * for more info.
     *
     * @var int
     */
    public $revenuesplitid;

    /**
     * Ticket layout ID
     *
     * See ticket layouts
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_communicationanddesign_ticketlayouts)
     * for more info.
     *
     * @var int
     */
    public $ticketlayoutid;

    /**
     * Maximum number of tickets for this event that can be added to a basket
     *
     * @var int
     */
    public $maxnbrofticketsperbasket;

    /**
     * Event status
     *
     * @var int
     */
    public $currentstatus;

    /**
     * @var object
     */
    public $prices;

    /**
     * Per-sales channel information about when this event is for sale.
     *
     * @var \Ticketmatic\Model\EventSalesChannel[]
     */
    public $saleschannels;

    /**
     * @var object
     */
    public $availability;

    /**
     * Created timestamp
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack Event from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Event
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Event(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "subtitle" => isset($obj->subtitle) ? $obj->subtitle : null,
            "subtitle2" => isset($obj->subtitle2) ? $obj->subtitle2 : null,
            "webremark" => isset($obj->webremark) ? $obj->webremark : null,
            "startts" => isset($obj->startts) ? Json::unpackTimestamp($obj->startts) : null,
            "salestartts" => isset($obj->salestartts) ? Json::unpackTimestamp($obj->salestartts) : null,
            "saleendts" => isset($obj->saleendts) ? Json::unpackTimestamp($obj->saleendts) : null,
            "publishedts" => isset($obj->publishedts) ? Json::unpackTimestamp($obj->publishedts) : null,
            "endts" => isset($obj->endts) ? Json::unpackTimestamp($obj->endts) : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "externalcode" => isset($obj->externalcode) ? $obj->externalcode : null,
            "productionid" => isset($obj->productionid) ? $obj->productionid : null,
            "locationid" => isset($obj->locationid) ? $obj->locationid : null,
            "locationname" => isset($obj->locationname) ? $obj->locationname : null,
            "seatingplanid" => isset($obj->seatingplanid) ? $obj->seatingplanid : null,
            "seatingplanpricelistid" => isset($obj->seatingplanpricelistid) ? $obj->seatingplanpricelistid : null,
            "seatingplaneventspecificprices" => isset($obj->seatingplaneventspecificprices) ? $obj->seatingplaneventspecificprices : null,
            "seatingplancontingents" => isset($obj->seatingplancontingents) ? $obj->seatingplancontingents : null,
            "contingents" => isset($obj->contingents) ? $obj->contingents : null,
            "priceavailabilityid" => isset($obj->priceavailabilityid) ? $obj->priceavailabilityid : null,
            "ticketfeeid" => isset($obj->ticketfeeid) ? $obj->ticketfeeid : null,
            "revenuesplitid" => isset($obj->revenuesplitid) ? $obj->revenuesplitid : null,
            "ticketlayoutid" => isset($obj->ticketlayoutid) ? $obj->ticketlayoutid : null,
            "maxnbrofticketsperbasket" => isset($obj->maxnbrofticketsperbasket) ? $obj->maxnbrofticketsperbasket : null,
            "currentstatus" => isset($obj->currentstatus) ? $obj->currentstatus : null,
            "prices" => isset($obj->prices) ? $obj->prices : null,
            "saleschannels" => isset($obj->saleschannels) ? Json::unpackArray("EventSalesChannel", $obj->saleschannels) : null,
            "availability" => isset($obj->availability) ? $obj->availability : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize Event to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->subtitle)) {
            $result["subtitle"] = strval($this->subtitle);
        }
        if (!is_null($this->subtitle2)) {
            $result["subtitle2"] = strval($this->subtitle2);
        }
        if (!is_null($this->webremark)) {
            $result["webremark"] = strval($this->webremark);
        }
        if (!is_null($this->startts)) {
            $result["startts"] = Json::packTimestamp($this->startts);
        }
        if (!is_null($this->salestartts)) {
            $result["salestartts"] = Json::packTimestamp($this->salestartts);
        }
        if (!is_null($this->saleendts)) {
            $result["saleendts"] = Json::packTimestamp($this->saleendts);
        }
        if (!is_null($this->publishedts)) {
            $result["publishedts"] = Json::packTimestamp($this->publishedts);
        }
        if (!is_null($this->endts)) {
            $result["endts"] = Json::packTimestamp($this->endts);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->externalcode)) {
            $result["externalcode"] = strval($this->externalcode);
        }
        if (!is_null($this->productionid)) {
            $result["productionid"] = intval($this->productionid);
        }
        if (!is_null($this->locationid)) {
            $result["locationid"] = intval($this->locationid);
        }
        if (!is_null($this->locationname)) {
            $result["locationname"] = strval($this->locationname);
        }
        if (!is_null($this->seatingplanid)) {
            $result["seatingplanid"] = intval($this->seatingplanid);
        }
        if (!is_null($this->seatingplanpricelistid)) {
            $result["seatingplanpricelistid"] = intval($this->seatingplanpricelistid);
        }
        if (!is_null($this->seatingplaneventspecificprices)) {
            $result["seatingplaneventspecificprices"] = $this->seatingplaneventspecificprices;
        }
        if (!is_null($this->seatingplancontingents)) {
            $result["seatingplancontingents"] = $this->seatingplancontingents;
        }
        if (!is_null($this->contingents)) {
            $result["contingents"] = $this->contingents;
        }
        if (!is_null($this->priceavailabilityid)) {
            $result["priceavailabilityid"] = intval($this->priceavailabilityid);
        }
        if (!is_null($this->ticketfeeid)) {
            $result["ticketfeeid"] = intval($this->ticketfeeid);
        }
        if (!is_null($this->revenuesplitid)) {
            $result["revenuesplitid"] = intval($this->revenuesplitid);
        }
        if (!is_null($this->ticketlayoutid)) {
            $result["ticketlayoutid"] = intval($this->ticketlayoutid);
        }
        if (!is_null($this->maxnbrofticketsperbasket)) {
            $result["maxnbrofticketsperbasket"] = intval($this->maxnbrofticketsperbasket);
        }
        if (!is_null($this->currentstatus)) {
            $result["currentstatus"] = intval($this->currentstatus);
        }
        if (!is_null($this->prices)) {
            $result["prices"] = $this->prices;
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }

        return $result;
    }
}
