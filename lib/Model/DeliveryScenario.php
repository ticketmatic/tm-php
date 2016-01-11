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
 * A single delivery scenario.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios/get)
 * and the delivery scenarios endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios).
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
     * Name of the delivery scenario
     *
     * @var string
     */
    public $name;

    /**
     * A short description of the deilvery scenario. Will be shown to customers.
     *
     * @var string
     */
    public $shortdescription;

    /**
     * An internal description field. Will not be shown to customers.
     *
     * @var string
     */
    public $internalremark;

    /**
     * The type of this delivery scenario, defines when this delivery scenario is
     * triggered. The available values for this field can be found on the delivery
     * scenario overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios)
     * page.
     *
     * @var int
     */
    public $typeid;

    /**
     * A physical address is required
     *
     * @var bool
     */
    public $needsaddress;

    /**
     * The rules that define when this scenario is available. See the delivery scenario
     * overview
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios)
     * page for a description of this field
     *
     * **Note:** Not set when retrieving a list of delivery scenarios.
     *
     * @var \Ticketmatic\Model\DeliveryscenarioAvailability
     */
    public $availability;

    /**
     * The ID of the order mail template that will be used for sending out this
     * delivery scenario. Can be 0 to indicate that no mail should be sent
     *
     * @var int
     */
    public $ordermailtemplateid_delivery;

    /**
     * Are e-tickets allowed with this delivery scenario?
     *
     * @var int
     */
    public $allowetickets;

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

        return new DeliveryScenario(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "shortdescription" => isset($obj->shortdescription) ? $obj->shortdescription : null,
            "internalremark" => isset($obj->internalremark) ? $obj->internalremark : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "needsaddress" => isset($obj->needsaddress) ? $obj->needsaddress : null,
            "availability" => isset($obj->availability) ? DeliveryscenarioAvailability::fromJson($obj->availability) : null,
            "ordermailtemplateid_delivery" => isset($obj->ordermailtemplateid_delivery) ? $obj->ordermailtemplateid_delivery : null,
            "allowetickets" => isset($obj->allowetickets) ? $obj->allowetickets : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
        ));
    }

    /**
     * Serialize DeliveryScenario to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
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
        if (!is_null($this->needsaddress)) {
            $result["needsaddress"] = (bool)$this->needsaddress;
        }
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->ordermailtemplateid_delivery)) {
            $result["ordermailtemplateid_delivery"] = intval($this->ordermailtemplateid_delivery);
        }
        if (!is_null($this->allowetickets)) {
            $result["allowetickets"] = intval($this->allowetickets);
        }
        if (!is_null($this->createdts)) {
            $result["createdts"] = Json::packTimestamp($this->createdts);
        }
        if (!is_null($this->lastupdatets)) {
            $result["lastupdatets"] = Json::packTimestamp($this->lastupdatets);
        }
        if (!is_null($this->isarchived)) {
            $result["isarchived"] = (bool)$this->isarchived;
        }

        return $result;
    }
}
