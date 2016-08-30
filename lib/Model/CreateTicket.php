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
 * Info for adding a ticket
 * (https://apps.ticketmatic.com/#/knowledgebase/api/orders/addtickets) to an order
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Order).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CreateTicket).
 */
class CreateTicket implements \jsonSerializable
{
    /**
     * Create a new CreateTicket
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * The ticket type price ID for the new ticket. Either tickettypepriceid or
     * optionbundleid should be specified, not both.
     *
     * @var int
     */
    public $tickettypepriceid;

    /**
     * The id for the optionbundle you want to add a new ticket to. Either
     * tickettypepriceid or optionbundleid should be specified, not both.
     *
     * @var int
     */
    public $optionbundleid;

    /**
     * Should only be specified when optionbundleid is specified. The tickettypeid for
     * the ticket you want to add to the optionbundle.
     *
     * @var int
     */
    public $tickettypeid;

    /**
     * Voucher code to use (if any)
     *
     * @var string
     */
    public $vouchercode;

    /**
     * Manually select a specific ticket.
     *
     * @var int
     */
    public $ticketid;

    /**
     * Unpack CreateTicket from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CreateTicket
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new CreateTicket(array(
            "tickettypepriceid" => isset($obj->tickettypepriceid) ? $obj->tickettypepriceid : null,
            "optionbundleid" => isset($obj->optionbundleid) ? $obj->optionbundleid : null,
            "tickettypeid" => isset($obj->tickettypeid) ? $obj->tickettypeid : null,
            "vouchercode" => isset($obj->vouchercode) ? $obj->vouchercode : null,
            "ticketid" => isset($obj->ticketid) ? $obj->ticketid : null,
        ));
    }

    /**
     * Serialize CreateTicket to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->tickettypepriceid)) {
            $result["tickettypepriceid"] = intval($this->tickettypepriceid);
        }
        if (!is_null($this->optionbundleid)) {
            $result["optionbundleid"] = intval($this->optionbundleid);
        }
        if (!is_null($this->tickettypeid)) {
            $result["tickettypeid"] = intval($this->tickettypeid);
        }
        if (!is_null($this->vouchercode)) {
            $result["vouchercode"] = strval($this->vouchercode);
        }
        if (!is_null($this->ticketid)) {
            $result["ticketid"] = intval($this->ticketid);
        }

        return $result;
    }
}
