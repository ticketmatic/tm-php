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
 * A single delivery scenario.
 *
 * More info: see the get operation
 * (api/settings/ticketsales/deliveryscenarios/get) and the delivery scenarios
 * endpoint (api/settings/ticketsales/deliveryscenarios).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/DeliveryScenario).
 */
class DeliveryScenario implements \jsonSerializable
{
    /**
     * Create a new DeliveryScenario
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
     * **Note:** Ignored when creating a new delivery scenario.
     *
     * **Note:** Ignored when updating an existing delivery scenario.
     *
     * @var int
     */
    public $id;

    /**
     * The type of this delivery scenario, defines when this delivery scenario is
     * triggered. The available values for this field can be found on the delivery
     * scenario overview (api/settings/ticketsales/deliveryscenarios) page.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the delivery scenario
     *
     * @var string
     */
    public $name;

    /**
     * Are e-tickets allowed with this delivery scenario?
     *
     * @var int
     */
    public $allowetickets;

    /**
     * The rules that define when this scenario is available. See the delivery scenario
     * overview (api/settings/ticketsales/deliveryscenarios) page for a description of
     * this field
     *
     * **Note:** Not set when retrieving a list of delivery scenarios.
     *
     * @var \Ticketmatic\Model\DeliveryscenarioAvailability
     */
    public $availability;

    /**
     * The delivery status the order will transition to when the trigger occurs.
     *
     * @var int
     */
    public $deliverystatusaftertrigger;

    /**
     * A very short description of the fee that is applicable.
     *
     * @var string
     */
    public $feedescription;

    /**
     * An internal description field. Will not be shown to customers.
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
     * A physical address is required
     *
     * @var bool
     */
    public $needsaddress;

    /**
     * The ID of the order mail template that will be used for sending out when
     * changing to delivery state 'delivered'. Can be 0 to indicate that no mail should
     * be sent
     *
     * @var int
     */
    public $ordermailtemplateid_delivery;

    /**
     * The ID of the order mail template that will be used for sending out when
     * changing to delivery state 'delivery started'. Can be 0 to indicate that no mail
     * should be sent
     *
     * @var int
     */
    public $ordermailtemplateid_deliverystarted;

    /**
     * A short description of the deilvery scenario. Will be shown to customers.
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
     * **Note:** Ignored when creating a new delivery scenario.
     *
     * **Note:** Ignored when updating an existing delivery scenario.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new delivery scenario.
     *
     * **Note:** Ignored when updating an existing delivery scenario.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new delivery scenario.
     *
     * **Note:** Ignored when updating an existing delivery scenario.
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
     * Unpack DeliveryScenario from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\DeliveryScenario
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        $result = new DeliveryScenario(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "allowetickets" => isset($obj->allowetickets) ? $obj->allowetickets : null,
            "availability" => isset($obj->availability) ? DeliveryscenarioAvailability::fromJson($obj->availability) : null,
            "deliverystatusaftertrigger" => isset($obj->deliverystatusaftertrigger) ? $obj->deliverystatusaftertrigger : null,
            "feedescription" => isset($obj->feedescription) ? $obj->feedescription : null,
            "internalremark" => isset($obj->internalremark) ? $obj->internalremark : null,
            "logo" => isset($obj->logo) ? $obj->logo : null,
            "mailorganization" => isset($obj->mailorganization) ? $obj->mailorganization : null,
            "needsaddress" => isset($obj->needsaddress) ? $obj->needsaddress : null,
            "ordermailtemplateid_delivery" => isset($obj->ordermailtemplateid_delivery) ? $obj->ordermailtemplateid_delivery : null,
            "ordermailtemplateid_deliverystarted" => isset($obj->ordermailtemplateid_deliverystarted) ? $obj->ordermailtemplateid_deliverystarted : null,
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
     * Serialize DeliveryScenario to JSON.
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
        if (!is_null($this->allowetickets)) {
            $result["allowetickets"] = intval($this->allowetickets);
        }
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->deliverystatusaftertrigger)) {
            $result["deliverystatusaftertrigger"] = intval($this->deliverystatusaftertrigger);
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
        if (!is_null($this->needsaddress)) {
            $result["needsaddress"] = (bool)$this->needsaddress;
        }
        if (!is_null($this->ordermailtemplateid_delivery)) {
            $result["ordermailtemplateid_delivery"] = intval($this->ordermailtemplateid_delivery);
        }
        if (!is_null($this->ordermailtemplateid_deliverystarted)) {
            $result["ordermailtemplateid_deliverystarted"] = intval($this->ordermailtemplateid_deliverystarted);
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
