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
 * A single ticket in an order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OrderTicket).
 */
class OrderTicket implements \jsonSerializable
{
    /**
     * Create a new OrderTicket
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
     * Order ID
     *
     * @var int
     */
    public $orderid;

    /**
     * The barcode of this ticket, will be visible when the order is confirmed
     *
     * @var string
     */
    public $barcode;

    /**
     * The id of the product this ticket is linked to
     *
     * @var int
     */
    public $bundleid;

    /**
     * The key of the fixedseat variant this ticket is linked to
     *
     * @var string
     */
    public $bundlevariant;

    /**
     * Accesscontrol status for this ticket
     *
     * @var int
     */
    public $cachedaccesscontrolstatus;

    /**
     * The timestamp of the last delivery of this ticket
     *
     * @var \DateTime
     */
    public $deliveredts;

    /**
     * Event id
     *
     * @var int
     */
    public $eventid;

    /**
     * Ticket price
     *
     * @var float
     */
    public $price;

    /**
     * Pricetype id
     *
     * @var int
     */
    public $pricetypeid;

    /**
     * Seat coordinate - x
     *
     * @var float
     */
    public $seatcachedvisualx;

    /**
     * Seat coordinate - y
     *
     * @var float
     */
    public $seatcachedvisualy;

    /**
     * Description of the ticket
     *
     * @var string
     */
    public $seatdescription;

    /**
     * Seated ref
     *
     * @var string
     */
    public $seated_ref;

    /**
     * Name of the seat
     *
     * @var string
     */
    public $seatname;

    /**
     * Seatzone ID
     *
     * @var int
     */
    public $seatzoneid;

    /**
     * Service charge
     *
     * @var float
     */
    public $servicecharge;

    /**
     * Ticket holder ID
     *
     * @var int
     */
    public $ticketholderid;

    /**
     * Name for the ticket holder
     *
     * @var string
     */
    public $ticketname;

    /**
     * Contingent ID
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Contingent name
     *
     * @var string
     */
    public $tickettypename;

    /**
     * Id for the tickettypeprice of this ticket for the order
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * The contact this ticket is transferred to
     *
     * @var int
     */
    public $transferredto;

    /**
     * The voucher code that was linked to this ticket
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * Unpack OrderTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OrderTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OrderTicket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "barcode" => isset($obj->barcode) ? $obj->barcode : null,
            "bundleid" => isset($obj->bundleid) ? $obj->bundleid : null,
            "bundlevariant" => isset($obj->bundlevariant) ? $obj->bundlevariant : null,
            "cachedaccesscontrolstatus" => isset($obj->cachedaccesscontrolstatus) ? $obj->cachedaccesscontrolstatus : null,
            "deliveredts" => isset($obj->deliveredts) ? Json::unpackTimestamp($obj->deliveredts) : null,
            "eventid" => isset($obj->eventid) ? $obj->eventid : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "pricetypeid" => isset($obj->pricetypeid) ? $obj->pricetypeid : null,
            "seatcachedvisualx" => isset($obj->seatcachedvisualx) ? $obj->seatcachedvisualx : null,
            "seatcachedvisualy" => isset($obj->seatcachedvisualy) ? $obj->seatcachedvisualy : null,
            "seatdescription" => isset($obj->seatdescription) ? $obj->seatdescription : null,
            "seated_ref" => isset($obj->seated_ref) ? $obj->seated_ref : null,
            "seatname" => isset($obj->seatname) ? $obj->seatname : null,
            "seatzoneid" => isset($obj->seatzoneid) ? $obj->seatzoneid : null,
            "servicecharge" => isset($obj->servicecharge) ? $obj->servicecharge : null,
            "ticketholderid" => isset($obj->ticketholderid) ? $obj->ticketholderid : null,
            "ticketname" => isset($obj->ticketname) ? $obj->ticketname : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "tickettypename" => isset($obj->tickettypename) ? $obj->tickettypename : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "transferredto" => isset($obj->transferredto) ? $obj->transferredto : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
        ));
    }

    /**
     * Serialize OrderTicket to JSON.
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
        if (!is_null($this->barcode)) {
            $result["barcode"] = strval($this->barcode);
        }
        if (!is_null($this->bundleid)) {
            $result["bundleid"] = intval($this->bundleid);
        }
        if (!is_null($this->bundlevariant)) {
            $result["bundlevariant"] = strval($this->bundlevariant);
        }
        if (!is_null($this->cachedaccesscontrolstatus)) {
            $result["cachedaccesscontrolstatus"] = intval($this->cachedaccesscontrolstatus);
        }
        if (!is_null($this->deliveredts)) {
            $result["deliveredts"] = Json::packTimestamp($this->deliveredts);
        }
        if (!is_null($this->eventid)) {
            $result["eventid"] = intval($this->eventid);
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
        }
        if (!is_null($this->pricetypeid)) {
            $result["pricetypeid"] = intval($this->pricetypeid);
        }
        if (!is_null($this->seatcachedvisualx)) {
            $result["seatcachedvisualx"] = floatval($this->seatcachedvisualx);
        }
        if (!is_null($this->seatcachedvisualy)) {
            $result["seatcachedvisualy"] = floatval($this->seatcachedvisualy);
        }
        if (!is_null($this->seatdescription)) {
            $result["seatdescription"] = strval($this->seatdescription);
        }
        if (!is_null($this->seated_ref)) {
            $result["seated_ref"] = strval($this->seated_ref);
        }
        if (!is_null($this->seatname)) {
            $result["seatname"] = strval($this->seatname);
        }
        if (!is_null($this->seatzoneid)) {
            $result["seatzoneid"] = intval($this->seatzoneid);
        }
        if (!is_null($this->servicecharge)) {
            $result["servicecharge"] = floatval($this->servicecharge);
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
        if (!is_null($this->tickettypename)) {
            $result["tickettypename"] = strval($this->tickettypename);
        }
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }
        if (!is_null($this->transferredto)) {
            $result["transferredto"] = intval($this->transferredto);
        }
        if (!is_null($this->vouchercodeid)) {
            $result["vouchercodeid"] = intval($this->vouchercodeid);
        }

        return $result;
    }
}
