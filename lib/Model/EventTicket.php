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
 * A single ticket.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/EventTicket).
 */
class EventTicket implements \jsonSerializable
{
    /**
     * Create a new EventTicket
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Ticket ID
     *
     * @var int
     */
    public $id;

    /**
     * Link to the order the ticket is contained in
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $orderid;

    /**
     * The id of the scanner used for the last succesful entry
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $accesscontrollastenteredscandeviceid;

    /**
     * The timestamp of the last succesful entry with this ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var \DateTime
     */
    public $accesscontrollastenteredts;

    /**
     * The id of the scanner used for the last succesful exit
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $accesscontrollastexitscandeviceid;

    /**
     * The timestamp of the last succesful exit with this ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var \DateTime
     */
    public $accesscontrollastexitts;

    /**
     * The access control status for this ticket. 0 means not scanned, 1 means
     * succesful entry, 2 means succesful exit
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $accesscontrolstatus;

    /**
     * Ticket barcode
     *
     * @var string
     */
    public $barcode;

    /**
     * Link to the bundle (orderproduct) that this ticket belongs to.
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $bundleid;

    /**
     * Link to the locktype used for locking the ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $locktypeid;

    /**
     * Fee for the ticket in the order
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var float
     */
    public $orderfee;

    /**
     * Price for the ticket in the order (without fee)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var float
     */
    public $price;

    /**
     * String to string key-value mapping of properties
     *
     * @var string[]
     */
    public $properties;

    /**
     * The seat description for this ticket (only for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatdescription;

    /**
     * Seat ID (for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatid;

    /**
     * Number indicating the priority for this ticket for the best available algorithm.
     * Tickets with a higher priority will be considered first when performing a best
     * available allocation.
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $seatpriority;

    /**
     * Row number for the ticket (only for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatrownumber;

    /**
     * Seat number for the ticket (only for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatseatnumber;

    /**
     * Optional seatzone for the ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $seatzoneid;

    /**
     * Zone name for the ticket (only for seated tickets)
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $seatzonename;

    /**
     * Optional link to the contact that is the ticketholder for this ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $ticketholderid;

    /**
     * Optional name on the ticket
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var string
     */
    public $ticketname;

    /**
     * Link to the contingent this ticket belongs to
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Link to the tickettypeprice that is assigned to this ticket for the order.
     * Through the tickettypeprice you can retrieve the pricetype
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * Link to the vouchercode that was used to reserve this ticket.
     *
     * **Note:** Ignored in the result for updating tickets
     *
     * **Note:** Ignored when updating tickets
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

    /**
     * Unpack EventTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\EventTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new EventTicket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "accesscontrollastenteredscandeviceid" => isset($obj->accesscontrollastenteredscandeviceid) ? $obj->accesscontrollastenteredscandeviceid : null,
            "accesscontrollastenteredts" => isset($obj->accesscontrollastenteredts) ? Json::unpackTimestamp($obj->accesscontrollastenteredts) : null,
            "accesscontrollastexitscandeviceid" => isset($obj->accesscontrollastexitscandeviceid) ? $obj->accesscontrollastexitscandeviceid : null,
            "accesscontrollastexitts" => isset($obj->accesscontrollastexitts) ? Json::unpackTimestamp($obj->accesscontrollastexitts) : null,
            "accesscontrolstatus" => isset($obj->accesscontrolstatus) ? $obj->accesscontrolstatus : null,
            "barcode" => isset($obj->barcode) ? $obj->barcode : null,
            "bundleid" => isset($obj->bundleid) ? $obj->bundleid : null,
            "locktypeid" => isset($obj->locktypeid) ? $obj->locktypeid : null,
            "orderfee" => isset($obj->orderfee) ? $obj->orderfee : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "properties" => isset($obj->properties) ? $obj->properties : null,
            "seatdescription" => isset($obj->seatdescription) ? $obj->seatdescription : null,
            "seatid" => isset($obj->seatid) ? $obj->seatid : null,
            "seatpriority" => isset($obj->seatpriority) ? $obj->seatpriority : null,
            "seatrownumber" => isset($obj->seatrownumber) ? $obj->seatrownumber : null,
            "seatseatnumber" => isset($obj->seatseatnumber) ? $obj->seatseatnumber : null,
            "seatzoneid" => isset($obj->seatzoneid) ? $obj->seatzoneid : null,
            "seatzonename" => isset($obj->seatzonename) ? $obj->seatzonename : null,
            "ticketholderid" => isset($obj->ticketholderid) ? $obj->ticketholderid : null,
            "ticketname" => isset($obj->ticketname) ? $obj->ticketname : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
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
     * Serialize EventTicket to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->accesscontrollastenteredscandeviceid)) {
            $result["accesscontrollastenteredscandeviceid"] = intval($this->accesscontrollastenteredscandeviceid);
        }
        if (!is_null($this->accesscontrollastenteredts)) {
            $result["accesscontrollastenteredts"] = Json::packTimestamp($this->accesscontrollastenteredts);
        }
        if (!is_null($this->accesscontrollastexitscandeviceid)) {
            $result["accesscontrollastexitscandeviceid"] = intval($this->accesscontrollastexitscandeviceid);
        }
        if (!is_null($this->accesscontrollastexitts)) {
            $result["accesscontrollastexitts"] = Json::packTimestamp($this->accesscontrollastexitts);
        }
        if (!is_null($this->accesscontrolstatus)) {
            $result["accesscontrolstatus"] = intval($this->accesscontrolstatus);
        }
        if (!is_null($this->barcode)) {
            $result["barcode"] = strval($this->barcode);
        }
        if (!is_null($this->bundleid)) {
            $result["bundleid"] = intval($this->bundleid);
        }
        if (!is_null($this->locktypeid)) {
            $result["locktypeid"] = intval($this->locktypeid);
        }
        if (!is_null($this->orderfee)) {
            $result["orderfee"] = floatval($this->orderfee);
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }
        if (!is_null($this->seatdescription)) {
            $result["seatdescription"] = strval($this->seatdescription);
        }
        if (!is_null($this->seatid)) {
            $result["seatid"] = strval($this->seatid);
        }
        if (!is_null($this->seatpriority)) {
            $result["seatpriority"] = intval($this->seatpriority);
        }
        if (!is_null($this->seatrownumber)) {
            $result["seatrownumber"] = strval($this->seatrownumber);
        }
        if (!is_null($this->seatseatnumber)) {
            $result["seatseatnumber"] = strval($this->seatseatnumber);
        }
        if (!is_null($this->seatzoneid)) {
            $result["seatzoneid"] = intval($this->seatzoneid);
        }
        if (!is_null($this->seatzonename)) {
            $result["seatzonename"] = strval($this->seatzonename);
        }
        if (!is_null($this->ticketholderid)) {
            $result["ticketholderid"] = intval($this->ticketholderid);
        }
        if (!is_null($this->ticketname)) {
            $result["ticketname"] = strval($this->ticketname);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }
        if (!is_null($this->vouchercodeid)) {
            $result["vouchercodeid"] = intval($this->vouchercodeid);
        }


        if (is_array($this->custom_fields)) {
            foreach ($this->custom_fields as $key => $value) {
                $result["c_" . $key] = $value;
            }
        }

        return $result;
    }
}
