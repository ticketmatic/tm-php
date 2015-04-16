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

/**
 * A set of fields to create a payment method.
 *
 * More info: see payment method
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PaymentMethod), the
 * create operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentmethods/create)
 * and the payment methods endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentmethods).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CreatePaymentMethod).
 */
class CreatePaymentMethod implements \jsonSerializable
{
    /**
     * Create a new CreatePaymentMethod
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $internalremark;

    /**
     * @var int
     */
    public $paymentmethodtypeid;

    /**
     * @var int
     */
    public $paymentmethodreceiverid;

    /**
     * @var \Ticketmatic\Model\PaymentmethodConfig
     */
    public $config;

    /**
     * Unpack CreatePaymentMethod from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CreatePaymentMethod
     */
    public static function fromJson($obj) {
        return new CreatePaymentMethod(array(
            "name" => $obj->name,
            "internalremark" => $obj->internalremark,
            "paymentmethodtypeid" => $obj->paymentmethodtypeid,
            "paymentmethodreceiverid" => $obj->paymentmethodreceiverid,
            "config" => PaymentmethodConfig::fromJson($obj->config),
        ));
    }

    /**
     * Serialize CreatePaymentMethod to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->internalremark)) {
                $result["internalremark"] = strval($this->internalremark);
            }
            if (!is_null($this->paymentmethodtypeid)) {
                $result["paymentmethodtypeid"] = intval($this->paymentmethodtypeid);
            }
            if (!is_null($this->paymentmethodreceiverid)) {
                $result["paymentmethodreceiverid"] = intval($this->paymentmethodreceiverid);
            }
            if (!is_null($this->config)) {
                $result["config"] = $this->config;
            }

        }
        return $result;
    }
}
