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
 * A single sales channel.
 *
 * More info: see the get operation (api/settings/ticketsales/saleschannels/get)
 * and the sales channels endpoint (api/settings/ticketsales/saleschannels).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/SalesChannel).
 */
class SalesChannel implements \jsonSerializable
{
    /**
     * Create a new SalesChannel
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
     * **Note:** Ignored when creating a new sales channel.
     *
     * **Note:** Ignored when updating an existing sales channel.
     *
     * @var int
     */
    public $id;

    /**
     * The type of this sales channel, defines where this sales channel will be used.
     * The available values for this field can be found on the sales channel overview
     * (api/settings/ticketsales/saleschannels) page.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name of the sales channel
     *
     * @var string
     */
    public $name;

    /**
     * The ID of the order mail template to use for sending confirmations. Can be 0 to
     * indicate that no mail should be sent
     *
     * @var int
     */
    public $ordermailtemplateid_confirmation;

    /**
     * Always send the confirmation, regardless of the payment method configuration
     *
     * @var bool
     */
    public $ordermailtemplateid_confirmation_sendalways;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new sales channel.
     *
     * **Note:** Ignored when updating an existing sales channel.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new sales channel.
     *
     * **Note:** Ignored when updating an existing sales channel.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new sales channel.
     *
     * **Note:** Ignored when updating an existing sales channel.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack SalesChannel from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\SalesChannel
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new SalesChannel(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "ordermailtemplateid_confirmation" => isset($obj->ordermailtemplateid_confirmation) ? $obj->ordermailtemplateid_confirmation : null,
            "ordermailtemplateid_confirmation_sendalways" => isset($obj->ordermailtemplateid_confirmation_sendalways) ? $obj->ordermailtemplateid_confirmation_sendalways : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize SalesChannel to JSON.
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
        if (!is_null($this->ordermailtemplateid_confirmation)) {
            $result["ordermailtemplateid_confirmation"] = intval($this->ordermailtemplateid_confirmation);
        }
        if (!is_null($this->ordermailtemplateid_confirmation_sendalways)) {
            $result["ordermailtemplateid_confirmation_sendalways"] = (bool)$this->ordermailtemplateid_confirmation_sendalways;
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

        return $result;
    }
}
