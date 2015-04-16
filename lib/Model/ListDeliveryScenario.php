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
 * An item in a list of delivery scenarios. This differs from the normal
 * DeliveryScenario type: not all fields are present in the list. More info: see
 * the getlist operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios/getlist)
 * and the delivery scenarios endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_ticketsales_deliveryscenarios).
 */
class ListDeliveryScenario implements \jsonSerializable
{
    /**
     * Create a new ListDeliveryScenario
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
     * Whether or not this item is archived
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Unpack ListDeliveryScenario from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\ListDeliveryScenario
     */
    public static function fromJson($obj) {
        return new ListDeliveryScenario(array(
            "id" => $obj->id,
            "name" => $obj->name,
            "shortdescription" => $obj->shortdescription,
            "internalremark" => $obj->internalremark,
            "typeid" => $obj->typeid,
            "needsaddress" => $obj->needsaddress,
            "ordermailtemplateid_delivery" => $obj->ordermailtemplateid_delivery,
            "allowetickets" => $obj->allowetickets,
            "createdts" => Json::unpackTimestamp($obj->createdts),
            "lastupdatets" => Json::unpackTimestamp($obj->lastupdatets),
            "isarchived" => $obj->isarchived,
        ));
    }

    /**
     * Serialize ListDeliveryScenario to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
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
                $result["needsaddress"] = boolval($this->needsaddress);
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
                $result["isarchived"] = boolval($this->isarchived);
            }

        }
        return $result;
    }
}
