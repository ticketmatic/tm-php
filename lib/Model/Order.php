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
 * A single Order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Order).
 */
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
     * Total amount paid
     *
     * **Note:** Ignored when importing orders.
     *
     * @var float
     */
    public $amountpaid;

    /**
     * Whether or not auto / script order fees should be calculated
     *
     * **Note:** Ignored when importing orders.
     *
     * @var bool
     */
    public $calculate_ordercosts;

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
     * Information on the deferred payment scenario. Structure depends on payment
     * method
     *
     * **Note:** Ignored when importing orders.
     *
     * @var object[]
     */
    public $deferredpaymentproperties;

    /**
     * Address used when delivering physically
     *
     * @var \Ticketmatic\Model\Address
     */
    public $deliveryaddress;

    /**
     * Delivery scenario ID
     *
     * See delivery scenarios (api/settings/ticketsales/deliveryscenarios) for more
     * info.
     *
     * @var int
     */
    public $deliveryscenarioid;

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
     * Whether the expired order has been handled (and optionally expiry mail has been
     * sent)
     *
     * @var bool
     */
    public $expiryhandled;

    /**
     * When the order will expire
     *
     * @var \DateTime
     */
    public $expiryts;

    /**
     * First name (only with minimal output)
     *
     * @var string
     */
    public $firstname;

    /**
     * Indicates of the order has an open payment request with a PSP.
     *
     * **Note:** Ignored when importing orders.
     *
     * @var bool
     */
    public $hasopenpaymentrequest;

    /**
     * Has customer authenticated?
     *
     * **Note:** Ignored when importing orders.
     *
     * @var bool
     */
    public $isauthenticatedcustomer;

    /**
     * Last name (only with minimal output)
     *
     * @var string
     */
    public $lastname;

    /**
     * Related objects
     *
     * See the lookup fields on the getlist operation (api/orders/getlist) for a full
     * description.
     *
     * **Note:** Ignored when importing orders.
     *
     * @var object[]
     */
    public $lookup;

    /**
     * Number of tickets in the order. Read-only
     *
     * **Note:** Ignored when importing orders.
     *
     * @var int
     */
    public $nbroftickets;

    /**
     * Order fees for the order
     *
     * @var \Ticketmatic\Model\Ordercost[]
     */
    public $ordercosts;

    /**
     * Payments for the order
     *
     * @var \Ticketmatic\Model\Payment[]
     */
    public $payments;

    /**
     * Payment scenario ID
     *
     * See payment scenarios (api/settings/ticketsales/paymentscenarios) for more info.
     *
     * @var int
     */
    public $paymentscenarioid;

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
     * **Note:** Ignored when importing orders.
     *
     * @var int
     */
    public $paymentstatus;

    /**
     * Products in the order
     *
     * @var \Ticketmatic\Model\OrderProduct[]
     */
    public $products;

    /**
     * Promocodes active for the Order
     *
     * **Note:** Ignored when importing orders.
     *
     * @var string[]
     */
    public $promocodes;

    /**
     * Queue tokens for rate limiting
     *
     * **Note:** Ignored when importing orders.
     *
     * @var int[]
     */
    public $queuetokens;

    /**
     * Whether the overdue order has been handled (and optionally reminder mail has
     * been sent)
     *
     * @var bool
     */
    public $rappelhandled;

    /**
     * When the reminder mail will be sent
     *
     * @var \DateTime
     */
    public $rappelts;

    /**
     * Sales channel ID
     *
     * See sales channels (api/settings/ticketsales/saleschannels) for more info.
     *
     * @var int
     */
    public $saleschannelid;

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
     * **Note:** Ignored when importing orders.
     *
     * @var int
     */
    public $status;

    /**
     * Tickets in the order
     *
     * @var \Ticketmatic\Model\OrderTicket[]
     */
    public $tickets;

    /**
     * Total order amount
     *
     * Includes all costs and fees.
     *
     * **Note:** Ignored when importing orders.
     *
     * @var float
     */
    public $totalamount;

    /**
     * Reference to the webskin that is used for showing the orderdetail page.
     *
     * **Note:** Ignored when importing orders.
     *
     * @var int
     */
    public $webskinid;

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
     * Custom fields
     *
     * @var array
     */
    public $custom_fields;

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

        $result = new Order(array(
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "amountpaid" => isset($obj->amountpaid) ? $obj->amountpaid : null,
            "calculate_ordercosts" => isset($obj->calculate_ordercosts) ? $obj->calculate_ordercosts : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "deferredpaymentproperties" => isset($obj->deferredpaymentproperties) ? $obj->deferredpaymentproperties : null,
            "deliveryaddress" => isset($obj->deliveryaddress) ? Address::fromJson($obj->deliveryaddress) : null,
            "deliveryscenarioid" => isset($obj->deliveryscenarioid) ? $obj->deliveryscenarioid : null,
            "deliverystatus" => isset($obj->deliverystatus) ? $obj->deliverystatus : null,
            "expiryhandled" => isset($obj->expiryhandled) ? $obj->expiryhandled : null,
            "expiryts" => isset($obj->expiryts) ? Json::unpackTimestamp($obj->expiryts) : null,
            "firstname" => isset($obj->firstname) ? $obj->firstname : null,
            "hasopenpaymentrequest" => isset($obj->hasopenpaymentrequest) ? $obj->hasopenpaymentrequest : null,
            "isauthenticatedcustomer" => isset($obj->isauthenticatedcustomer) ? $obj->isauthenticatedcustomer : null,
            "lastname" => isset($obj->lastname) ? $obj->lastname : null,
            "lookup" => isset($obj->lookup) ? $obj->lookup : null,
            "nbroftickets" => isset($obj->nbroftickets) ? $obj->nbroftickets : null,
            "ordercosts" => isset($obj->ordercosts) ? Json::unpackArray("Ordercost", $obj->ordercosts) : null,
            "payments" => isset($obj->payments) ? Json::unpackArray("Payment", $obj->payments) : null,
            "paymentscenarioid" => isset($obj->paymentscenarioid) ? $obj->paymentscenarioid : null,
            "paymentstatus" => isset($obj->paymentstatus) ? $obj->paymentstatus : null,
            "products" => isset($obj->products) ? Json::unpackArray("OrderProduct", $obj->products) : null,
            "promocodes" => isset($obj->promocodes) ? $obj->promocodes : null,
            "queuetokens" => isset($obj->queuetokens) ? $obj->queuetokens : null,
            "rappelhandled" => isset($obj->rappelhandled) ? $obj->rappelhandled : null,
            "rappelts" => isset($obj->rappelts) ? Json::unpackTimestamp($obj->rappelts) : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "status" => isset($obj->status) ? $obj->status : null,
            "tickets" => isset($obj->tickets) ? Json::unpackArray("OrderTicket", $obj->tickets) : null,
            "totalamount" => isset($obj->totalamount) ? $obj->totalamount : null,
            "webskinid" => isset($obj->webskinid) ? $obj->webskinid : null,
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
     * Serialize Order to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->amountpaid)) {
            $result["amountpaid"] = floatval($this->amountpaid);
        }
        if (!is_null($this->calculate_ordercosts)) {
            $result["calculate_ordercosts"] = (bool)$this->calculate_ordercosts;
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
        }
        if (!is_null($this->deferredpaymentproperties)) {
            $result["deferredpaymentproperties"] = $this->deferredpaymentproperties;
        }
        if (!is_null($this->deliveryaddress)) {
            $result["deliveryaddress"] = $this->deliveryaddress;
        }
        if (!is_null($this->deliveryscenarioid)) {
            $result["deliveryscenarioid"] = intval($this->deliveryscenarioid);
        }
        if (!is_null($this->deliverystatus)) {
            $result["deliverystatus"] = intval($this->deliverystatus);
        }
        if (!is_null($this->expiryhandled)) {
            $result["expiryhandled"] = (bool)$this->expiryhandled;
        }
        if (!is_null($this->expiryts)) {
            $result["expiryts"] = Json::packTimestamp($this->expiryts);
        }
        if (!is_null($this->firstname)) {
            $result["firstname"] = strval($this->firstname);
        }
        if (!is_null($this->hasopenpaymentrequest)) {
            $result["hasopenpaymentrequest"] = (bool)$this->hasopenpaymentrequest;
        }
        if (!is_null($this->isauthenticatedcustomer)) {
            $result["isauthenticatedcustomer"] = (bool)$this->isauthenticatedcustomer;
        }
        if (!is_null($this->lastname)) {
            $result["lastname"] = strval($this->lastname);
        }
        if (!is_null($this->lookup)) {
            $result["lookup"] = $this->lookup;
        }
        if (!is_null($this->nbroftickets)) {
            $result["nbroftickets"] = intval($this->nbroftickets);
        }
        if (!is_null($this->ordercosts)) {
            $result["ordercosts"] = $this->ordercosts;
        }
        if (!is_null($this->payments)) {
            $result["payments"] = $this->payments;
        }
        if (!is_null($this->paymentscenarioid)) {
            $result["paymentscenarioid"] = intval($this->paymentscenarioid);
        }
        if (!is_null($this->paymentstatus)) {
            $result["paymentstatus"] = intval($this->paymentstatus);
        }
        if (!is_null($this->products)) {
            $result["products"] = $this->products;
        }
        if (!is_null($this->promocodes)) {
            $result["promocodes"] = $this->promocodes;
        }
        if (!is_null($this->queuetokens)) {
            $result["queuetokens"] = $this->queuetokens;
        }
        if (!is_null($this->rappelhandled)) {
            $result["rappelhandled"] = (bool)$this->rappelhandled;
        }
        if (!is_null($this->rappelts)) {
            $result["rappelts"] = Json::packTimestamp($this->rappelts);
        }
        if (!is_null($this->saleschannelid)) {
            $result["saleschannelid"] = intval($this->saleschannelid);
        }
        if (!is_null($this->status)) {
            $result["status"] = intval($this->status);
        }
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
        }
        if (!is_null($this->totalamount)) {
            $result["totalamount"] = floatval($this->totalamount);
        }
        if (!is_null($this->webskinid)) {
            $result["webskinid"] = intval($this->webskinid);
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
