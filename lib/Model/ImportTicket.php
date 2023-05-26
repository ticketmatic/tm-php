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
 * Used when importing order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ImportTicket).
 */
class ImportTicket implements \jsonSerializable
{
    /**
     * Create a new ImportTicket
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Manually select a specific ticket.
     *
     * @var int
     */
    public $id;

    /**
     * If boolean is set to true, the price field is used (even if set to 0) to
     * determine the price for this ticket
     *
     * @var bool
     */
    public $overrideprice;

    /**
     * If boolean is set to true, the servicecharge field is used (even if set to 0) to
     * determine the servicecharge for this ticket
     *
     * @var bool
     */
    public $overrideservicecharge;

    /**
     * Ticket price, will always be used if larger then 0.
     *
     * @var float
     */
    public $price;

    /**
     * Seatzone ID
     *
     * @var int
     */
    public $seatzoneid;

    /**
     * Service charge for this ticket
     *
     * @var float
     */
    public $servicecharge;

    /**
     * If this ticket should be linked to a contact, set the ticketholderid
     *
     * @var int
     */
    public $ticketholderid;

    /**
     * DEPRECATED: Use ticketholderid
     *
     * @var string
     */
    public $ticketholdername;

    /**
     * The tickettype ID for the ticket.
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * The ticket type price ID for the new ticket. Either tickettypepriceid or
     * optionbundleid should be specified, not both.
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * Voucher code to use (if any)
     *
     * @var string
     */
    public $vouchercode;

    /**
     * The voucher code to link to this ticket
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * Unpack ImportTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ImportTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ImportTicket(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "overrideprice" => isset($obj->overrideprice) ? $obj->overrideprice : null,
            "overrideservicecharge" => isset($obj->overrideservicecharge) ? $obj->overrideservicecharge : null,
            "price" => isset($obj->price) ? $obj->price : null,
            "seatzoneid" => isset($obj->seatzoneid) ? $obj->seatzoneid : null,
            "servicecharge" => isset($obj->servicecharge) ? $obj->servicecharge : null,
            "ticketholderid" => isset($obj->ticketholderid) ? $obj->ticketholderid : null,
            "ticketholdername" => isset($obj->ticketholdername) ? $obj->ticketholdername : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "vouchercode" => isset($obj->vouchercode) ? $obj->vouchercode : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
        ));
    }

    /**
     * Serialize ImportTicket to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->overrideprice)) {
            $result["overrideprice"] = (bool)$this->overrideprice;
        }
        if (!is_null($this->overrideservicecharge)) {
            $result["overrideservicecharge"] = (bool)$this->overrideservicecharge;
        }
        if (!is_null($this->price)) {
            $result["price"] = floatval($this->price);
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
        if (!is_null($this->ticketholdername)) {
            $result["ticketholdername"] = strval($this->ticketholdername);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }
        if (!is_null($this->vouchercode)) {
            $result["vouchercode"] = strval($this->vouchercode);
        }
        if (!is_null($this->vouchercodeid)) {
            $result["vouchercodeid"] = intval($this->vouchercodeid);
        }

        return $result;
    }
}
