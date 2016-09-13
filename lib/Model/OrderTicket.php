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
     * Contingent ID
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Seatzone ID
     *
     * @var int
     */
    public $seatzoneid;

    /**
     * Id for the tickettypeprice of this ticket for the order
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * Ticket price
     *
     * @var float
     */
    public $price;

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
     * The abo ticketid for tickets that belong to an abo
     *
     * @var int
     */
    public $aboparentid;

    /**
     * Event id
     *
     * @var int
     */
    public $eventid;

    /**
     * Pricetype id
     *
     * @var int
     */
    public $pricetypeid;

    /**
     * Description of the ticket
     *
     * @var string
     */
    public $seatdescription;

    /**
     * Name of the seat
     *
     * @var string
     */
    public $seatname;

    /**
     * Contingent name
     *
     * @var string
     */
    public $tickettypename;

    /**
     * The voucher code that was linked to this ticket
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * The id of the product this ticket is linked to
     *
     * @var int
     */
    public $bundleid;

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
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "seatzoneid" => isset($obj->seatzoneid) ? $obj->seatzoneid : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "servicecharge" => isset($obj->servicecharge) ? $obj->servicecharge : null,
            "ticketholderid" => isset($obj->ticketholderid) ? $obj->ticketholderid : null,
            "ticketname" => isset($obj->ticketname) ? $obj->ticketname : null,
            "aboparentid" => isset($obj->aboparentid) ? $obj->aboparentid : null,
            "eventid" => isset($obj->eventid) ? $obj->eventid : null,
            "pricetypeid" => isset($obj->pricetypeid) ? $obj->pricetypeid : null,
            "seatdescription" => isset($obj->seatdescription) ? $obj->seatdescription : null,
            "seatname" => isset($obj->seatname) ? $obj->seatname : null,
            "tickettypename" => isset($obj->tickettypename) ? $obj->tickettypename : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
            "bundleid" => isset($obj->bundleid) ? $obj->bundleid : null,
        ));
    }

    /**
     * Serialize OrderTicket to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->seatzoneid)) {
            $result["seatzoneid"] = intval($this->seatzoneid);
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
        if (!is_null($this->ticketholderid)) {
            $result["ticketholderid"] = intval($this->ticketholderid);
        }
        if (!is_null($this->ticketname)) {
            $result["ticketname"] = strval($this->ticketname);
        }
        if (!is_null($this->aboparentid)) {
            $result["aboparentid"] = intval($this->aboparentid);
        }
        if (!is_null($this->eventid)) {
            $result["eventid"] = intval($this->eventid);
        }
        if (!is_null($this->pricetypeid)) {
            $result["pricetypeid"] = intval($this->pricetypeid);
        }
        if (!is_null($this->seatdescription)) {
            $result["seatdescription"] = strval($this->seatdescription);
        }
        if (!is_null($this->seatname)) {
            $result["seatname"] = strval($this->seatname);
        }
        if (!is_null($this->tickettypename)) {
            $result["tickettypename"] = strval($this->tickettypename);
        }
        if (!is_null($this->vouchercodeid)) {
            $result["vouchercodeid"] = intval($this->vouchercodeid);
        }
        if (!is_null($this->bundleid)) {
            $result["bundleid"] = intval($this->bundleid);
        }

        return $result;
    }
}
