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
 * Used to import an order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ImportOrder).
 */
class ImportOrder implements \jsonSerializable
{
    /**
     * Create a new ImportOrder
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
     * Address used when delivering physically
     *
     * @var \Ticketmatic\Model\Address
     */
    public $deliveryaddress;

    /**
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
     * Indicates if the expired order has been handled. If set to false when importing,
     * Ticketmatic will send our expiry mails if configured.
     *
     * @var bool
     */
    public $expiryhandled;

    /**
     * When the order will expire. If this is specified expiryhandled should also be
     * specified.
     *
     * @var \DateTime
     */
    public $expiryts;

    /**
     * Order fees for the order
     *
     * @var \Ticketmatic\Model\ImportOrdercost[]
     */
    public $ordercosts;

    /**
     * Payments in the order
     *
     * @var \Ticketmatic\Model\ImportPayment[]
     */
    public $payments;

    /**
     * See payment scenarios (api/settings/ticketsales/paymentscenarios) for more info.
     *
     * @var int
     */
    public $paymentscenarioid;

    /**
     * Products in the order
     *
     * @var \Ticketmatic\Model\ImportProduct[]
     */
    public $products;

    /**
     * Indicates if the overdue order has been handled. If set to false when importing,
     * Ticketmatic will send our reminder mails if configured.
     *
     * @var bool
     */
    public $rappelhandled;

    /**
     * When a reminder mail will be sent. If this is specified rappelhandled should
     * also be specified.
     *
     * @var \DateTime
     */
    public $rappelts;

    /**
     * See sales channels (api/settings/ticketsales/saleschannels) for more info.
     *
     * @var int
     */
    public $saleschannelid;

    /**
     * Tickets in the order
     *
     * @var \Ticketmatic\Model\ImportTicket[]
     */
    public $tickets;

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
     * Unpack ImportOrder from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ImportOrder
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new ImportOrder(array(
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "code" => isset($obj->code) ? $obj->code : null,
            "customerid" => isset($obj->customerid) ? $obj->customerid : null,
            "deliveryaddress" => isset($obj->deliveryaddress) ? Address::fromJson($obj->deliveryaddress) : null,
            "deliveryscenarioid" => isset($obj->deliveryscenarioid) ? $obj->deliveryscenarioid : null,
            "deliverystatus" => isset($obj->deliverystatus) ? $obj->deliverystatus : null,
            "expiryhandled" => isset($obj->expiryhandled) ? $obj->expiryhandled : null,
            "expiryts" => isset($obj->expiryts) ? Json::unpackTimestamp($obj->expiryts) : null,
            "ordercosts" => isset($obj->ordercosts) ? Json::unpackArray("ImportOrdercost", $obj->ordercosts) : null,
            "payments" => isset($obj->payments) ? Json::unpackArray("ImportPayment", $obj->payments) : null,
            "paymentscenarioid" => isset($obj->paymentscenarioid) ? $obj->paymentscenarioid : null,
            "products" => isset($obj->products) ? Json::unpackArray("ImportProduct", $obj->products) : null,
            "rappelhandled" => isset($obj->rappelhandled) ? $obj->rappelhandled : null,
            "rappelts" => isset($obj->rappelts) ? Json::unpackTimestamp($obj->rappelts) : null,
            "saleschannelid" => isset($obj->saleschannelid) ? $obj->saleschannelid : null,
            "tickets" => isset($obj->tickets) ? Json::unpackArray("ImportTicket", $obj->tickets) : null,
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
     * Serialize ImportOrder to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->orderid)) {
            $result["orderid"] = intval($this->orderid);
        }
        if (!is_null($this->code)) {
            $result["code"] = strval($this->code);
        }
        if (!is_null($this->customerid)) {
            $result["customerid"] = intval($this->customerid);
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
        if (!is_null($this->ordercosts)) {
            $result["ordercosts"] = $this->ordercosts;
        }
        if (!is_null($this->payments)) {
            $result["payments"] = $this->payments;
        }
        if (!is_null($this->paymentscenarioid)) {
            $result["paymentscenarioid"] = intval($this->paymentscenarioid);
        }
        if (!is_null($this->products)) {
            $result["products"] = $this->products;
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
        if (!is_null($this->tickets)) {
            $result["tickets"] = $this->tickets;
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
