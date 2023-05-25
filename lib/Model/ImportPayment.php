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
 * Used when importing an order.
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/ImportPayment).
 */
class ImportPayment implements \jsonSerializable
{
    /**
     * Create a new ImportPayment
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Amount
     *
     * @var float
     */
    public $amount;

    /**
     * Timestamp of payment
     *
     * @var \DateTime
     */
    public $paidts;

    /**
     * Payment method id
     *
     * @var int
     */
    public $paymentmethodid;

    /**
     * Additional properties for the payment. Can contain a variable structure.
     *
     * @var object[]
     */
    public $properties;

    /**
     * Voucher code that was used for this payment
     *
     * @var string
     */
    public $vouchercode;

    /**
     * Voucher code id that was used for this payment
     *
     * @var int
     */
    public $vouchercodeid;

    /**
     * Unpack ImportPayment from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ImportPayment
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new ImportPayment(array(
            "amount" => isset($obj->amount) ? $obj->amount : null,
            "paidts" => isset($obj->paidts) ? Json::unpackTimestamp($obj->paidts) : null,
            "paymentmethodid" => isset($obj->paymentmethodid) ? $obj->paymentmethodid : null,
            "properties" => isset($obj->properties) ? $obj->properties : null,
            "vouchercode" => isset($obj->vouchercode) ? $obj->vouchercode : null,
            "vouchercodeid" => isset($obj->vouchercodeid) ? $obj->vouchercodeid : null,
        ));
    }

    /**
     * Serialize ImportPayment to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->amount)) {
            $result["amount"] = floatval($this->amount);
        }
        if (!is_null($this->paidts)) {
            $result["paidts"] = Json::packTimestamp($this->paidts);
        }
        if (!is_null($this->paymentmethodid)) {
            $result["paymentmethodid"] = intval($this->paymentmethodid);
        }
        if (!is_null($this->properties)) {
            $result["properties"] = $this->properties;
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
