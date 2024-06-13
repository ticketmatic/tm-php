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
 * A single payment method.
 *
 * More info: see the get operation (api/settings/ticketsales/paymentmethods/get)
 * and the payment methods endpoint (api/settings/ticketsales/paymentmethods).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PaymentMethod).
 */
class PaymentMethod implements \jsonSerializable
{
    /**
     * Create a new PaymentMethod
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Unique ID
     *
     * **Note:** Ignored when creating a new payment method.
     *
     * **Note:** Ignored when updating an existing payment method.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the payment method
     *
     * @var string
     */
    public $name;

    /**
     * Specific configuration for the payment method, content depends on the payment
     * method type.
     *
     * **Note:** Not set when retrieving a list of payment methods.
     *
     * @var object[]
     */
    public $config;

    /**
     * Internal remark, will not be shown to customers
     *
     * @var string
     */
    public $internalremark;

    /**
     * Type of the paymentmethod. For a list of possible types see here
     * (api/settings/ticketsales/paymentmethods)
     *
     * @var int
     */
    public $paymentmethodtypeid;

    /**
     * Payment Service Provider this payment method is linked to
     *
     * @var int
     */
    public $pspid;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new payment method.
     *
     * **Note:** Ignored when updating an existing payment method.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new payment method.
     *
     * **Note:** Ignored when updating an existing payment method.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new payment method.
     *
     * **Note:** Ignored when updating an existing payment method.
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
     * Unpack PaymentMethod from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PaymentMethod
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new PaymentMethod(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "config" => isset($obj->config) ? $obj->config : null,
            "internalremark" => isset($obj->internalremark) ? $obj->internalremark : null,
            "paymentmethodtypeid" => isset($obj->paymentmethodtypeid) ? $obj->paymentmethodtypeid : null,
            "pspid" => isset($obj->pspid) ? $obj->pspid : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
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
     * Serialize PaymentMethod to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->config)) {
            $result["config"] = $this->config;
        }
        if (!is_null($this->internalremark)) {
            $result["internalremark"] = strval($this->internalremark);
        }
        if (!is_null($this->paymentmethodtypeid)) {
            $result["paymentmethodtypeid"] = intval($this->paymentmethodtypeid);
        }
        if (!is_null($this->pspid)) {
            $result["pspid"] = intval($this->pspid);
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
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
