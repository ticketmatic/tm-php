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
 * A single Event.
 *
 * ## Status
 *
 * The `currentstatus` field of an event can have any of the following values:
 *
 * * **Draft (`19001`)**
 *
 * * **Active (`19002`)**
 *
 * * **Closed (`19003`)**
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Event).
 */
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
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
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
     * The audio preview url for the event
     *
     * @var string
     */
    public $audiopreviewurl;

    /**
     * Information on the availability of tickets per contingent. Read-only.
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \Ticketmatic\Model\EventContingentAvailability[]
     */
    public $availability;

    /**
     * Event code.
     *
     * Used as a unique identifier in web sales.
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var string
     */
    public $code;

    /**
     * Information about the contingents in the Event that are not in the seatingplan
     *
     * @var \Ticketmatic\Model\EventContingent[]
     */
    public $contingents;

    /**
     * Event status
     *
     * The available values for this field can be found on the Event (api/types/Event)
     * page.
     *
     * @var int
     */
    public $currentstatus;

    /**
     * Description of the event, visible for ticket buyers
     *
     * @var string
     */
    public $description;

    /**
     * Event end time
     *
     * @var \DateTime
     */
    public $endts;

    /**
     * External event code.
     *
     * This field is typically set when importing data from other systems.
     *
     * @var string
     */
    public $externalcode;

    /**
     * The image url for the event display image
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var string
     */
    public $image;

    /**
     * Practical info for the event, visible for ticket buyers
     *
     * @var string
     */
    public $info;

    /**
     * Layout parameters for the event
     *
     * @var \Ticketmatic\Model\Layout
     */
    public $layout;

    /**
     * Event location ID
     *
     * See event locations (api/settings/events/eventlocations) for more information.
     *
     * @var int
     */
    public $locationid;

    /**
     * Event location name
     *
     * Automatically derived using `locationid`.
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var string
     */
    public $locationname;

    /**
     * Maximum number of tickets for this event that can be added to a basket
     *
     * @var int
     */
    public $maxnbrofticketsperbasket;

    /**
     * Opt-in set id
     *
     * @var int
     */
    public $optinsetid;

    /**
     * Preview urls for the event.
     *
     * @var \Ticketmatic\Model\EventPreview[]
     */
    public $previews;

    /**
     * Information on the available prices for the event
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \Ticketmatic\Model\EventPrices
     */
    public $prices;

    /**
     * Production ID
     *
     * @var int
     */
    public $productionid;

    /**
     * Event publish time
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \DateTime
     */
    public $publishedts;

    /**
     * Queue ID
     *
     * See rate limiting (api/ratelimiting) for more information.
     *
     * @var int
     */
    public $queuetoken;

    /**
     * DEPRECATED
     *
     * @var int
     */
    public $revenuesplitid;

    /**
     * Time of end of sales.
     *
     * Used for all sales channels for which no specific sales period has been defined.
     *
     * @var \DateTime
     */
    public $saleendts;

    /**
     * Per-sales channel information about when this event is for sale.
     *
     * @var \Ticketmatic\Model\EventSalesChannel[]
     */
    public $saleschannels;

    /**
     * Time of start of sales.
     *
     * Used for all sales channels for which no specific sales period has been defined.
     *
     * @var \DateTime
     */
    public $salestartts;

    /**
     * Salestatus messages id
     *
     * @var int
     */
    public $salestatusmessagesid;

    /**
     * Schedule for the event, visible for ticket buyers
     *
     * @var string
     */
    public $schedule;

    /**
     * Allow or disallow leaving single seats on their own.
     *
     * @var bool
     */
    public $seatallowsingle;

    /**
     * @var string
     */
    public $seated_chartkey;

    /**
     * Seated contingents
     *
     * @var \Ticketmatic\Model\EventContingent[]
     */
    public $seated_contingents;

    /**
     * Information about the contingents defined in the seatingplan. Read-only.
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \Ticketmatic\Model\EventSeatingplanContingent[]
     */
    public $seatingplancontingents;

    /**
     * Event specific prices in addition to the prices defined in the field
     * `seatingplanpricelistid`. Prices from the pricelist and the event specific
     * prices are combined in one pricelist for the event. The optional position
     * attribute defines where the event specific prices will be positioned in the
     * resulting pricelist
     *
     * @var \Ticketmatic\Model\PricelistPrices
     */
    public $seatingplaneventspecificprices;

    /**
     * Seating plan ID
     *
     * Only set for events with fixed seats.
     *
     * @var int
     */
    public $seatingplanid;

    /**
     * Name of the seatingplanlocktemplate to apply linking a seatingplanid to this
     * event. This is not a numeric id but the name of the lock template as specified
     * in the seatingplan's logicalplan.
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var string
     */
    public $seatingplanlocktemplate;

    /**
     * Price list ID for fixed seats.
     *
     * Only set for events with fixed seats. See price lists
     * (api/settings/pricing/pricelists) for more information.
     *
     * @var int
     */
    public $seatingplanpricelistid;

    /**
     * Enable or disable seat selection for customers.
     *
     * @var bool
     */
    public $seatselection;

    /**
     * Segmentation tags
     *
     * @var string[]
     */
    public $segmentationtags;

    /**
     * servicemailids
     *
     * @var int[]
     */
    public $servicemailids;

    /**
     * Short description of the event, visible for ticket buyers
     *
     * @var string
     */
    public $shortdescription;

    /**
     * Social distance type. Determines if social distance must be practiced.
     *
     * @var int
     */
    public $socialdistance;

    /**
     * Event start time
     *
     * @var \DateTime
     */
    public $startts;

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
     * Event tags
     *
     * @var string[]
     */
    public $tags;

    /**
     * Ticket fee ID
     *
     * Determines which ticket fee rules are used for this event. See ticket fees
     * (api/settings/pricing/ticketfees) for more information.
     *
     * @var int
     */
    public $ticketfeeid;

    /**
     * Ticketinfo id
     *
     * @var int
     */
    public $ticketinfoid;

    /**
     * Ticket layout ID
     *
     * See ticket layouts (api/settings/communicationanddesign/ticketlayouts) for more
     * information.
     *
     * @var int
     */
    public $ticketlayoutid;

    /**
     * Determines the total maximum amount of tickets that can be sold for event.
     *
     * @var int
     */
    public $totalmaxtickets;

    /**
     * Translation of event fields
     *
     * @var string[]
     */
    public $translations;

    /**
     * Upsell id
     *
     * @var int
     */
    public $upsellid;

    /**
     * The type of the waiting list the event uses
     *
     * @var int
     */
    public $waitinglisttype;

    /**
     * Small description that will be shown on the sales pages of this event
     *
     * @var string
     */
    public $webremark;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new event.
     *
     * **Note:** Ignored when updating an existing event.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

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

        $result = new Event(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "audiopreviewurl" => isset($obj->audiopreviewurl) ? $obj->audiopreviewurl : null,
            "availability" => isset($obj->availability) ? Json::unpackArray("EventContingentAvailability", $obj->availability) : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "contingents" => isset($obj->contingents) ? Json::unpackArray("EventContingent", $obj->contingents) : null,
            "currentstatus" => isset($obj->currentstatus) ? $obj->currentstatus : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "endts" => isset($obj->endts) ? Json::unpackTimestamp($obj->endts) : null,
            "externalcode" => isset($obj->externalcode) ? $obj->externalcode : null,
            "image" => isset($obj->image) ? $obj->image : null,
            "info" => isset($obj->info) ? $obj->info : null,
            "layout" => isset($obj->layout) ? Layout::fromJson($obj->layout) : null,
            "locationid" => isset($obj->locationid) ? $obj->locationid : null,
            "locationname" => isset($obj->locationname) ? $obj->locationname : null,
            "maxnbrofticketsperbasket" => isset($obj->maxnbrofticketsperbasket) ? $obj->maxnbrofticketsperbasket : null,
            "optinsetid" => isset($obj->optinsetid) ? $obj->optinsetid : null,
            "previews" => isset($obj->previews) ? Json::unpackArray("EventPreview", $obj->previews) : null,
            "prices" => isset($obj->prices) ? EventPrices::fromJson($obj->prices) : null,
            "productionid" => isset($obj->productionid) ? $obj->productionid : null,
            "publishedts" => isset($obj->publishedts) ? Json::unpackTimestamp($obj->publishedts) : null,
            "queuetoken" => isset($obj->queuetoken) ? $obj->queuetoken : null,
            "revenuesplitid" => isset($obj->revenuesplitid) ? $obj->revenuesplitid : null,
            "saleendts" => isset($obj->saleendts) ? Json::unpackTimestamp($obj->saleendts) : null,
            "saleschannels" => isset($obj->saleschannels) ? Json::unpackArray("EventSalesChannel", $obj->saleschannels) : null,
            "salestartts" => isset($obj->salestartts) ? Json::unpackTimestamp($obj->salestartts) : null,
            "salestatusmessagesid" => isset($obj->salestatusmessagesid) ? $obj->salestatusmessagesid : null,
            "schedule" => isset($obj->schedule) ? $obj->schedule : null,
            "seatallowsingle" => isset($obj->seatallowsingle) ? $obj->seatallowsingle : null,
            "seated_chartkey" => isset($obj->seated_chartkey) ? $obj->seated_chartkey : null,
            "seated_contingents" => isset($obj->seated_contingents) ? Json::unpackArray("EventContingent", $obj->seated_contingents) : null,
            "seatingplancontingents" => isset($obj->seatingplancontingents) ? Json::unpackArray("EventSeatingplanContingent", $obj->seatingplancontingents) : null,
            "seatingplaneventspecificprices" => isset($obj->seatingplaneventspecificprices) ? PricelistPrices::fromJson($obj->seatingplaneventspecificprices) : null,
            "seatingplanid" => isset($obj->seatingplanid) ? $obj->seatingplanid : null,
            "seatingplanlocktemplate" => isset($obj->seatingplanlocktemplate) ? $obj->seatingplanlocktemplate : null,
            "seatingplanpricelistid" => isset($obj->seatingplanpricelistid) ? $obj->seatingplanpricelistid : null,
            "seatselection" => isset($obj->seatselection) ? $obj->seatselection : null,
            "segmentationtags" => isset($obj->segmentationtags) ? $obj->segmentationtags : null,
            "servicemailids" => isset($obj->servicemailids) ? $obj->servicemailids : null,
            "shortdescription" => isset($obj->shortdescription) ? $obj->shortdescription : null,
            "socialdistance" => isset($obj->socialdistance) ? $obj->socialdistance : null,
            "startts" => isset($obj->startts) ? Json::unpackTimestamp($obj->startts) : null,
            "subtitle" => isset($obj->subtitle) ? $obj->subtitle : null,
            "subtitle2" => isset($obj->subtitle2) ? $obj->subtitle2 : null,
            "tags" => isset($obj->tags) ? $obj->tags : null,
            "ticketfeeid" => isset($obj->ticketfeeid) ? $obj->ticketfeeid : null,
            "ticketinfoid" => isset($obj->ticketinfoid) ? $obj->ticketinfoid : null,
            "ticketlayoutid" => isset($obj->ticketlayoutid) ? $obj->ticketlayoutid : null,
            "totalmaxtickets" => isset($obj->totalmaxtickets) ? $obj->totalmaxtickets : null,
            "translations" => isset($obj->translations) ? $obj->translations : null,
            "upsellid" => isset($obj->upsellid) ? $obj->upsellid : null,
            "waitinglisttype" => isset($obj->waitinglisttype) ? $obj->waitinglisttype : null,
            "webremark" => isset($obj->webremark) ? $obj->webremark : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));

        $result->custom_fields = array();
        foreach ($obj as $key => $value) {
            if (substr($key, 0, 2) === "c_") {
                $key = substr($key, 2);
                $result->custom_fields[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Serialize Event to JSON.
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
        if (!is_null($this->audiopreviewurl)) {
            $result["audiopreviewurl"] = strval($this->audiopreviewurl);
        }
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->contingents)) {
            $result["contingents"] = $this->contingents;
        }
        if (!is_null($this->currentstatus)) {
            $result["currentstatus"] = intval($this->currentstatus);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->endts)) {
            $result["endts"] = Json::packTimestamp($this->endts);
        }
        if (!is_null($this->externalcode)) {
            $result["externalcode"] = strval($this->externalcode);
        }
        if (!is_null($this->image)) {
            $result["image"] = strval($this->image);
        }
        if (!is_null($this->info)) {
            $result["info"] = strval($this->info);
        }
        if (!is_null($this->layout)) {
            $result["layout"] = $this->layout;
        }
        if (!is_null($this->locationid)) {
            $result["locationid"] = intval($this->locationid);
        }
        if (!is_null($this->locationname)) {
            $result["locationname"] = strval($this->locationname);
        }
        if (!is_null($this->maxnbrofticketsperbasket)) {
            $result["maxnbrofticketsperbasket"] = intval($this->maxnbrofticketsperbasket);
        }
        if (!is_null($this->optinsetid)) {
            $result["optinsetid"] = intval($this->optinsetid);
        }
        if (!is_null($this->previews)) {
            $result["previews"] = $this->previews;
        }
        if (!is_null($this->prices)) {
            $result["prices"] = $this->prices;
        }
        if (!is_null($this->productionid)) {
            $result["productionid"] = intval($this->productionid);
        }
        if (!is_null($this->publishedts)) {
            $result["publishedts"] = Json::packTimestamp($this->publishedts);
        }
        if (!is_null($this->queuetoken)) {
            $result["queuetoken"] = intval($this->queuetoken);
        }
        if (!is_null($this->revenuesplitid)) {
            $result["revenuesplitid"] = intval($this->revenuesplitid);
        }
        if (!is_null($this->saleendts)) {
            $result["saleendts"] = Json::packTimestamp($this->saleendts);
        }
        if (!is_null($this->saleschannels)) {
            $result["saleschannels"] = $this->saleschannels;
        }
        if (!is_null($this->salestartts)) {
            $result["salestartts"] = Json::packTimestamp($this->salestartts);
        }
        if (!is_null($this->salestatusmessagesid)) {
            $result["salestatusmessagesid"] = intval($this->salestatusmessagesid);
        }
        if (!is_null($this->schedule)) {
            $result["schedule"] = strval($this->schedule);
        }
        if (!is_null($this->seatallowsingle)) {
            $result["seatallowsingle"] = (bool)$this->seatallowsingle;
        }
        if (!is_null($this->seated_chartkey)) {
            $result["seated_chartkey"] = strval($this->seated_chartkey);
        }
        if (!is_null($this->seated_contingents)) {
            $result["seated_contingents"] = $this->seated_contingents;
        }
        if (!is_null($this->seatingplancontingents)) {
            $result["seatingplancontingents"] = $this->seatingplancontingents;
        }
        if (!is_null($this->seatingplaneventspecificprices)) {
            $result["seatingplaneventspecificprices"] = $this->seatingplaneventspecificprices;
        }
        if (!is_null($this->seatingplanid)) {
            $result["seatingplanid"] = intval($this->seatingplanid);
        }
        if (!is_null($this->seatingplanlocktemplate)) {
            $result["seatingplanlocktemplate"] = strval($this->seatingplanlocktemplate);
        }
        if (!is_null($this->seatingplanpricelistid)) {
            $result["seatingplanpricelistid"] = intval($this->seatingplanpricelistid);
        }
        if (!is_null($this->seatselection)) {
            $result["seatselection"] = (bool)$this->seatselection;
        }
        if (!is_null($this->segmentationtags)) {
            $result["segmentationtags"] = $this->segmentationtags;
        }
        if (!is_null($this->servicemailids)) {
            $result["servicemailids"] = $this->servicemailids;
        }
        if (!is_null($this->shortdescription)) {
            $result["shortdescription"] = strval($this->shortdescription);
        }
        if (!is_null($this->socialdistance)) {
            $result["socialdistance"] = intval($this->socialdistance);
        }
        if (!is_null($this->startts)) {
            $result["startts"] = Json::packTimestamp($this->startts);
        }
        if (!is_null($this->subtitle)) {
            $result["subtitle"] = strval($this->subtitle);
        }
        if (!is_null($this->subtitle2)) {
            $result["subtitle2"] = strval($this->subtitle2);
        }
        if (!is_null($this->tags)) {
            $result["tags"] = $this->tags;
        }
        if (!is_null($this->ticketfeeid)) {
            $result["ticketfeeid"] = intval($this->ticketfeeid);
        }
        if (!is_null($this->ticketinfoid)) {
            $result["ticketinfoid"] = intval($this->ticketinfoid);
        }
        if (!is_null($this->ticketlayoutid)) {
            $result["ticketlayoutid"] = intval($this->ticketlayoutid);
        }
        if (!is_null($this->totalmaxtickets)) {
            $result["totalmaxtickets"] = intval($this->totalmaxtickets);
        }
        if (!is_null($this->translations)) {
            $result["translations"] = $this->translations;
        }
        if (!is_null($this->upsellid)) {
            $result["upsellid"] = intval($this->upsellid);
        }
        if (!is_null($this->waitinglisttype)) {
            $result["waitinglisttype"] = intval($this->waitinglisttype);
        }
        if (!is_null($this->webremark)) {
            $result["webremark"] = strval($this->webremark);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }


        if (is_array($this->custom_fields)) {
            foreach ($this->custom_fields as $key => $value) {
                $result["c_" . $key] = $value;
            }
        }

        return $result;
    }
}
