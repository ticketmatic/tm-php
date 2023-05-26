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
 * A single payment scenario.
 *
 * More info: see the get operation (api/settings/ticketsales/paymentscenarios/get)
 * and the payment scenarios endpoint (api/settings/ticketsales/paymentscenarios).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PaymentScenario).
 */
class PaymentScenario implements \jsonSerializable
{
    /**
     * Create a new PaymentScenario
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
     * **Note:** Ignored when creating a new payment scenario.
     *
     * **Note:** Ignored when updating an existing payment scenario.
     *
     * @var int
     */
    public $id;

    /**
     * Type for the payment scenario. Can be 'Immediate payment' (2701), 'Mollie bank
     * transfer' (2702), 'Regular bank transfer' (2703), 'Deferred online payment'
     * (2704), 'Deferred other' (2705).
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the payment scenario
     *
     * @var string
     */
    public $name;

    /**
     * Rules that define in what conditions this payment scenario is available
     *
     * **Note:** Not set when retrieving a list of payment scenarios.
     *
     * @var \Ticketmatic\Model\PaymentscenarioAvailability
     */
    public $availability;

    /**
     * Beneficiary for the bank account number. Only used for type 2703 (Regular bank
     * transfer)
     *
     * @var string
     */
    public $bankaccountbeneficiary;

    /**
     * BIC code for the bank account number. Only used for type 2703 (Regular bank
     * transfer)
     *
     * @var string
     */
    public $bankaccountbic;

    /**
     * Bank account number to be used. Only used for type 2703 (Regular bank transfer)
     *
     * @var string
     */
    public $bankaccountnumber;

    /**
     * Rules that define when an order becomes expired. Not used for type 2701.
     *
     * **Note:** Not set when retrieving a list of payment scenarios.
     *
     * @var \Ticketmatic\Model\PaymentscenarioExpiryParameters
     */
    public $expiryparameters;

    /**
     * A very short description of the fee that is applicable.
     *
     * @var string
     */
    public $feedescription;

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
     * Logo url
     *
     * @var string
     */
    public $logo;

    /**
     * Send mail to organization if known
     *
     * @var bool
     */
    public $mailorganization;

    /**
     * Link to the order mail template that will be sent when the order is expired.
     * Can be 0 to indicate that no mail should be sent. Not used for type 2701.
     *
     * @var int
     */
    public $ordermailtemplateid_expiry;

    /**
     * Link to the order mail template that will be sent when the order is overdue.
     * Can be 0 to indicate that no mail should be sent. Not used for type 2701.
     *
     * @var int
     */
    public $ordermailtemplateid_overdue;

    /**
     * Link to the order mail template that will be sent as payment instruction.
     * Can be 0 to indicate that no mail should be sent. Not used for type 2701.
     *
     * @var int
     */
    public $ordermailtemplateid_paymentinstruction;

    /**
     * Rules that define when an order becomes overdue. Not used for type 2701.
     *
     * **Note:** Not set when retrieving a list of payment scenarios.
     *
     * @var \Ticketmatic\Model\PaymentscenarioOverdueParameters
     */
    public $overdueparameters;

    /**
     * Set of payment methods that are linked to this payment scenario. Depending on
     * the type, this field has different usage.
     *
     * @var int[]
     */
    public $paymentmethods;

    /**
     * Short description of the payment scenario, will be shown to customers
     *
     * @var string
     */
    public $shortdescription;

    /**
     * Parameter that sets the visibility of this scenario, can be either 'FULL' or
     * 'API'.
     *
     * @var string
     */
    public $visibility;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new payment scenario.
     *
     * **Note:** Ignored when updating an existing payment scenario.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new payment scenario.
     *
     * **Note:** Ignored when updating an existing payment scenario.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new payment scenario.
     *
     * **Note:** Ignored when updating an existing payment scenario.
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
     * Unpack PaymentScenario from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PaymentScenario
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new PaymentScenario(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "availability" => isset($obj->availability) ? PaymentscenarioAvailability::fromJson($obj->availability) : null,
            "bankaccountbeneficiary" => isset($obj->bankaccountbeneficiary) ? $obj->bankaccountbeneficiary : null,
            "bankaccountbic" => isset($obj->bankaccountbic) ? $obj->bankaccountbic : null,
            "bankaccountnumber" => isset($obj->bankaccountnumber) ? $obj->bankaccountnumber : null,
            "expiryparameters" => isset($obj->expiryparameters) ? PaymentscenarioExpiryParameters::fromJson($obj->expiryparameters) : null,
            "feedescription" => isset($obj->feedescription) ? $obj->feedescription : null,
            "internalremark" => isset($obj->internalremark) ? $obj->internalremark : null,
            "logo" => isset($obj->logo) ? $obj->logo : null,
            "mailorganization" => isset($obj->mailorganization) ? $obj->mailorganization : null,
            "ordermailtemplateid_expiry" => isset($obj->ordermailtemplateid_expiry) ? $obj->ordermailtemplateid_expiry : null,
            "ordermailtemplateid_overdue" => isset($obj->ordermailtemplateid_overdue) ? $obj->ordermailtemplateid_overdue : null,
            "ordermailtemplateid_paymentinstruction" => isset($obj->ordermailtemplateid_paymentinstruction) ? $obj->ordermailtemplateid_paymentinstruction : null,
            "overdueparameters" => isset($obj->overdueparameters) ? PaymentscenarioOverdueParameters::fromJson($obj->overdueparameters) : null,
            "paymentmethods" => isset($obj->paymentmethods) ? $obj->paymentmethods : null,
            "shortdescription" => isset($obj->shortdescription) ? $obj->shortdescription : null,
            "visibility" => isset($obj->visibility) ? $obj->visibility : null,
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
     * Serialize PaymentScenario to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->bankaccountbeneficiary)) {
            $result["bankaccountbeneficiary"] = strval($this->bankaccountbeneficiary);
        }
        if (!is_null($this->bankaccountbic)) {
            $result["bankaccountbic"] = strval($this->bankaccountbic);
        }
        if (!is_null($this->bankaccountnumber)) {
            $result["bankaccountnumber"] = strval($this->bankaccountnumber);
        }
        if (!is_null($this->expiryparameters)) {
            $result["expiryparameters"] = $this->expiryparameters;
        }
        if (!is_null($this->feedescription)) {
            $result["feedescription"] = strval($this->feedescription);
        }
        if (!is_null($this->internalremark)) {
            $result["internalremark"] = strval($this->internalremark);
        }
        if (!is_null($this->logo)) {
            $result["logo"] = strval($this->logo);
        }
        if (!is_null($this->mailorganization)) {
            $result["mailorganization"] = (bool)$this->mailorganization;
        }
        if (!is_null($this->ordermailtemplateid_expiry)) {
            $result["ordermailtemplateid_expiry"] = intval($this->ordermailtemplateid_expiry);
        }
        if (!is_null($this->ordermailtemplateid_overdue)) {
            $result["ordermailtemplateid_overdue"] = intval($this->ordermailtemplateid_overdue);
        }
        if (!is_null($this->ordermailtemplateid_paymentinstruction)) {
            $result["ordermailtemplateid_paymentinstruction"] = intval($this->ordermailtemplateid_paymentinstruction);
        }
        if (!is_null($this->overdueparameters)) {
            $result["overdueparameters"] = $this->overdueparameters;
        }
        if (!is_null($this->paymentmethods)) {
            $result["paymentmethods"] = $this->paymentmethods;
        }
        if (!is_null($this->shortdescription)) {
            $result["shortdescription"] = strval($this->shortdescription);
        }
        if (!is_null($this->visibility)) {
            $result["visibility"] = strval($this->visibility);
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
