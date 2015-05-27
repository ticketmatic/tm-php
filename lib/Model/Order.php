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

class Order implements \jsonSerializable
{
    /**
     * Create a new Order
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Order ID
     *
     * @var int
     */
    public $orderid;

    /**
     * Order status
     *
     * Possible values:
     *
     * * **21001**: Unconfirmed
     *
     * * **21002**: Confirmed
     *
     * * **21003**: Archived
     *
     * @var int
     */
    public $status;

    /**
     * Order code
     *
     * Used as a unique identifier in web sales.
     *
     * @var string
     */
    public $code;

    /**
     * Customer ID
     *
     * @var int
     */
    public $customerid;

    /**
     * Has customer authenticated?
     *
     * @var bool
     */
    public $isauthenticatedcustomer;

    /**
     * Total order amount
     *
     * Includes all costs and fees.
     *
     * @var float
     */
    public $totalamount;

    /**
     * Total amount paid
     *
     * @var float
     */
    public $amountpaid;

    /**
     * Payment status
     *
     * Possible values:
     *
     * * `0`: Incomplete
     *
     * * `1`: Fully paid
     *
     * * `2`: Overpaid
     *
     * @var int
     */
    public $paymentstatus;

    /**
     * Delivery status
     *
     * Possible values:
     *
     * * `2601`: Not delivered
     *
     * * `2602`: Delivered
     *
     * * `2603`: Changed after delivery
     *
     * @var int
     */
    public $deliverystatus;

    /**
     * Address used when delivering physically
     *
     * @var \Ticketmatic\Model\Address
     */
    public $deliveryaddress;

    /**
     * @var object
     */
    public $deferredpaymentproperties;

    /**
     * Sales channel ID
     *
     * See sales channels
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_saleschannels)
     * for more info.
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Payment scenario ID
     *
     * See payment scenarios
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentscenarios)
     * for more info.
     *
     * @var int
     */
    public $paymentscenarioid;

    /**
     * Delivery scenario ID
     *
     * See delivery scenarios
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios)
     * for more info.
     *
     * @var int
     */
    public $deliveryscenarioid;

    /**
     * When the reminder mail will be sent
     *
     * @var \DateTime
     */
    public $rappelts;

    /**
     * Whether the reminder mail has been sent
     *
     * @var bool
     */
    public $rappelsent;

    /**
     * When the order will expire
     *
     * @var \DateTime
     */
    public $expiryts;

    /**
     * @var \Ticketmatic\Model\Ticket[]
     */
    public $tickets;

    /**
     * @var object
     */
    public $payments;

    /**
     * Related objects
     *
     * See the lookup fields on the getlist operation
     * (https://apps.ticketmatic.com/#/knowledgebase/api/orders/getlist) for a full
     * description.
     *
     * @var object[]
     */
    public $lookup;

    /**
     * @var object
     */
    public $ordercosts;

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
     * Unpack Order from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Order
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Order(array(
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "isauthenticatedcustomer" => isset($obj->isauthenticatedcustomer) ? $obj->isauthenticatedcustomer : null,
            "totalamount" => isset($obj->totalamount) ? $obj->totalamount : null,
            "amountpaid" => isset($obj->amountpaid) ? $obj->amountpaid : null,
            "paymentstatus" => isset($obj->paymentstatus) ? $obj->paymentstatus : null,
            "deliverystatus" => isset($obj->deliverystatus) ? $obj->deliverystatus : null,
            "deliveryaddress" => isset($obj->deliveryaddress) ? Address::fromJson($obj->deliveryaddress) : null,
            "deferredpaymentproperties" => isset($obj->deferredpaymentproperties) ? $obj->deferredpaymentproperties : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "paymentscenarioid" => isset($obj->paymentscenarioid) ? $obj->paymentscenarioid : null,
            "deliveryscenarioid" => isset($obj->deliveryscenarioid) ? $obj->deliveryscenarioid : null,
            "rappelts" => isset($obj->rappelts) ? Json::unpackTimestamp($obj->rappelts) : null,
            "rappelsent" => isset($obj->rappelsent) ? $obj->rappelsent : null,
            "expiryts" => isset($obj->expiryts) ? Json::unpackTimestamp($obj->expiryts) : null,
            "tickets" => isset($obj->tickets) ? Json::unpackArray("Ticket", $obj->tickets) : null,
            "payments" => isset($obj->payments) ? $obj->payments : null,
            "lookup" => isset($obj->lookup) ? $obj->lookup : null,
            "ordercosts" => isset($obj->ordercosts) ? $obj->ordercosts : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize Order to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->status)) {
            $result["status"] = intval($this->status);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
        }
        if (!is_null($this->isauthenticatedcustomer)) {
            $result["isauthenticatedcustomer"] = (bool)$this->isauthenticatedcustomer;
        }
        if (!is_null($this->totalamount)) {
            $result["totalamount"] = floatval($this->totalamount);
        }
        if (!is_null($this->amountpaid)) {
            $result["amountpaid"] = floatval($this->amountpaid);
        }
        if (!is_null($this->paymentstatus)) {
            $result["paymentstatus"] = intval($this->paymentstatus);
        }
        if (!is_null($this->deliverystatus)) {
            $result["deliverystatus"] = intval($this->deliverystatus);
        }
        if (!is_null($this->deliveryaddress)) {
            $result["deliveryaddress"] = $this->deliveryaddress;
        }
        if (!is_null($this->deferredpaymentproperties)) {
            $result["deferredpaymentproperties"] = $this->deferredpaymentproperties;
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->paymentscenarioid)) {
            $result["paymentscenarioid"] = intval($this->paymentscenarioid);
        }
        if (!is_null($this->deliveryscenarioid)) {
            $result["deliveryscenarioid"] = intval($this->deliveryscenarioid);
        }
        if (!is_null($this->rappelts)) {
            $result["rappelts"] = Json::packTimestamp($this->rappelts);
        }
        if (!is_null($this->rappelsent)) {
            $result["rappelsent"] = (bool)$this->rappelsent;
        }
        if (!is_null($this->expiryts)) {
            $result["expiryts"] = Json::packTimestamp($this->expiryts);
        }
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
        }
        if (!is_null($this->payments)) {
            $result["payments"] = $this->payments;
        }
        if (!is_null($this->lookup)) {
            $result["lookup"] = $this->lookup;
        }
        if (!is_null($this->ordercosts)) {
            $result["ordercosts"] = $this->ordercosts;
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
