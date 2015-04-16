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
 * A set of fields to update a payment scenario.
 *
 * More info: see the update operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentscenarios/update)
 * and the payment scenarios endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_paymentscenarios).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/UpdatePaymentScenario).
 */
class UpdatePaymentScenario implements \jsonSerializable
{
    /**
     * Create a new UpdatePaymentScenario
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Name of the payment scenario
     *
     * @var string
     */
    public $name;

    /**
     * Short description of the payment scenario, will be shown to customers
     *
     * @var string
     */
    public $shortdescription;

    /**
     * An internal remark, which is never shown to customers. Can be used to
     * distinguish identically named payment scenarios.
     *
     * For example: You could have two `VISA` scenarios, one for the web sales and one
     * for the box office, each will have different fee configurations. Both will be
     * named `VISA`, this field can be used to distinguish them.
     *
     * @var string
     */
    public $internalremark;

    /**
     * @var int
     */
    public $typeid;

    /**
     * @var \Ticketmatic\Model\PaymentscenarioOverdueParameters
     */
    public $overdueparameters;

    /**
     * @var \Ticketmatic\Model\PaymentscenarioExpiryParameters
     */
    public $expiryparameters;

    /**
     * @var \Ticketmatic\Model\PaymentscenarioAvailability
     */
    public $availability;

    /**
     * @var int[]
     */
    public $paymentmethods;

    /**
     * @var int
     */
    public $ordermailtemplateid_paymentinstruction;

    /**
     * @var int
     */
    public $ordermailtemplateid_overdue;

    /**
     * @var int
     */
    public $ordermailtemplateid_expiry;

    /**
     * Unpack UpdatePaymentScenario from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\UpdatePaymentScenario
     */
    public static function fromJson($obj) {
        return new UpdatePaymentScenario(array(
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "overdueparameters" => PaymentscenarioOverdueParameters::fromJson($obj->overdueparameters),
            "expiryparameters" => PaymentscenarioExpiryParameters::fromJson($obj->expiryparameters),
            "availability" => PaymentscenarioAvailability::fromJson($obj->availability),
            "paymentmethods" => Json::unpackArray("int", $obj->paymentmethods),
            "ordermailtemplateid_paymentinstruction" => $obj->ordermailtemplateid_paymentinstruction,
            "ordermailtemplateid_overdue" => $obj->ordermailtemplateid_overdue,
            "ordermailtemplateid_expiry" => $obj->ordermailtemplateid_expiry,
        ));
    }

    /**
     * Serialize UpdatePaymentScenario to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
            if (!is_null($this->name)) {
                $result["name"] = strval($this->name);
            }
            if (!is_null($this->shortdescription)) {
                $result["shortdescription"] = strval($this->shortdescription);
            }
            if (!is_null($this->internalremark)) {
                $result["internalremark"] = strval($this->internalremark);
            }
            if (!is_null($this->typeid)) {
                $result["typeid"] = intval($this->typeid);
            }
            if (!is_null($this->overdueparameters)) {
                $result["overdueparameters"] = $this->overdueparameters;
            }
            if (!is_null($this->expiryparameters)) {
                $result["expiryparameters"] = $this->expiryparameters;
            }
            if (!is_null($this->availability)) {
                $result["availability"] = $this->availability;
            }
            if (!is_null($this->paymentmethods)) {
                $result["paymentmethods"] = $this->paymentmethods;
            }
            if (!is_null($this->ordermailtemplateid_paymentinstruction)) {
                $result["ordermailtemplateid_paymentinstruction"] = intval($this->ordermailtemplateid_paymentinstruction);
            }
            if (!is_null($this->ordermailtemplateid_overdue)) {
                $result["ordermailtemplateid_overdue"] = intval($this->ordermailtemplateid_overdue);
            }
            if (!is_null($this->ordermailtemplateid_expiry)) {
                $result["ordermailtemplateid_expiry"] = intval($this->ordermailtemplateid_expiry);
            }

        }
        return $result;
    }
}
