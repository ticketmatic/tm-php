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
 * A single payment.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/Payment).
 */
class Payment implements \jsonSerializable
{
    /**
     * Create a new Payment
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Payment ID
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
     * Payment method ID
     *
     * @var int
     */
    public $paymentmethodid;

    /**
     * Id for the original payment if this payment is a refund
     *
     * @var int
     */
    public $refundpaymentid;

    /**
     * Timestamp of payment
     *
     * @var \DateTime
     */
    public $paidts;

    /**
     * Payment amount
     *
     * @var float
     */
    public $amount;

    /**
     * Additional properties for the payment. Structure depends on the payment method
     *
     * @var object[]
     */
    public $properties;

    /**
     * Unpack Payment from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\Payment
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new Payment(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "orderid" => isset($obj->orderid) ? $obj->orderid : null,
            "paymentmethodid" => isset($obj->paymentmethodid) ? $obj->paymentmethodid : null,
            "refundpaymentid" => isset($obj->refundpaymentid) ? $obj->refundpaymentid : null,
            "paidts" => isset($obj->paidts) ? Json::unpackTimestamp($obj->paidts) : null,
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "properties" => isset($obj->properties) ? $obj->properties : null,
        ));
    }

    /**
     * Serialize Payment to JSON.
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
        if (!is_null($this->paymentmethodid)) {
            $result["paymentmethodid"] = intval($this->paymentmethodid);
        }
        if (!is_null($this->refundpaymentid)) {
            $result["refundpaymentid"] = intval($this->refundpaymentid);
        }
        if (!is_null($this->paidts)) {
            $result["paidts"] = Json::packTimestamp($this->paidts);
        }
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
        }

        return $result;
    }
}
