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

class Ticket implements \jsonSerializable
{
    /**
     * Create a new Ticket
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
     * @var object
     */
    public $tickettypeid;

    /**
     * @var object
     */
    public $baskettickettypepriceid;

    /**
     * @var object
     */
    public $price;

    /**
     * @var object
     */
    public $servicecharge;

    /**
     * Ticket holder ID
     *
     * @var int
     */
    public $ticketholderid;

    /**
     * @var object
     */
    public $ticketname;

    /**
     * @var object
     */
    public $aboparentid;

    /**
     * @var object
     */
    public $eventid;

    /**
     * @var object
     */
    public $pricetypeid;

    /**
     * @var object
     */
    public $seatdescription;

    /**
     * @var object
     */
    public $seatname;

    /**
     * @var object
     */
    public $tickettypename;

    /**
     * Unpack Ticket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Ticket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Ticket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "baskettickettypepriceid" => isset($obj->baskettickettypepriceid) ? $obj->baskettickettypepriceid : null,
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
        ));
    }

    /**
     * Serialize Ticket to JSON.
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
            $result["tickettypeid"] = $this->tickettypeid;
        }
        if (!is_null($this->baskettickettypepriceid)) {
            $result["baskettickettypepriceid"] = $this->baskettickettypepriceid;
        }
        if (!is_null($this->price)) {
            $result["price"] = $this->price;
        }
        if (!is_null($this->servicecharge)) {
            $result["servicecharge"] = $this->servicecharge;
        }
        if (!is_null($this->ticketholderid)) {
            $result["ticketholderid"] = intval($this->ticketholderid);
        }
        if (!is_null($this->ticketname)) {
            $result["ticketname"] = $this->ticketname;
        }
        if (!is_null($this->aboparentid)) {
            $result["aboparentid"] = $this->aboparentid;
        }
        if (!is_null($this->eventid)) {
            $result["eventid"] = $this->eventid;
        }
        if (!is_null($this->pricetypeid)) {
            $result["pricetypeid"] = $this->pricetypeid;
        }
        if (!is_null($this->seatdescription)) {
            $result["seatdescription"] = $this->seatdescription;
        }
        if (!is_null($this->seatname)) {
            $result["seatname"] = $this->seatname;
        }
        if (!is_null($this->tickettypename)) {
            $result["tickettypename"] = $this->tickettypename;
        }

        return $result;
    }
}
