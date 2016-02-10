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
 * A single phone number type.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_phonenumbertypes/get)
 * and the phone number types endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_phonenumbertypes).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/PhoneNumberType).
 */
class PhoneNumberType implements \jsonSerializable
{
    /**
     * Create a new PhoneNumberType
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
     * **Note:** Ignored when creating a new phone number type.
     *
     * **Note:** Ignored when updating an existing phone number type.
     *
     * @var int
     */
    public $id;

    /**
     * Name of the phone number type
     *
     * @var string
     */
    public $name;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new phone number type.
     *
     * **Note:** Ignored when updating an existing phone number type.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new phone number type.
     *
     * **Note:** Ignored when updating an existing phone number type.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new phone number type.
     *
     * **Note:** Ignored when updating an existing phone number type.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Unpack PhoneNumberType from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\PhoneNumberType
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new PhoneNumberType(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
        ));
    }

    /**
     * Serialize PhoneNumberType to JSON.
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
