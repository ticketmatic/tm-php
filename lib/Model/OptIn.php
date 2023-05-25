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
 * A single opt in.
 *
 * More info: see the get operation (api/settings/system/optins/get) and the opt
 * ins endpoint (api/settings/system/optins).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/OptIn).
 */
class OptIn implements \jsonSerializable
{
    /**
     * Create a new OptIn
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
     * **Note:** Ignored when creating a new opt in.
     *
     * **Note:** Ignored when updating an existing opt in.
     *
     * @var int
     */
    public $id;

    /**
     * Type of the opt-in. Can be 'Mandatory' (40001) or 'Optional' (40002)
     *
     * @var int
     */
    public $typeid;

    /**
     * Name
     *
     * @var string
     */
    public $name;

    /**
     * Sales channel where this opt-in is available
     *
     * @var \Ticketmatic\Model\OptInAvailability[]
     */
    public $availability;

    /**
     * Caption for the checkbox, needs to be set when typeid is `Optional` (40002)
     *
     * @var string
     */
    public $caption;

    /**
     * Description
     *
     * @var string
     */
    public $description;

    /**
     * Caption for no radio button, needs to be set when typeid is `Mandatory` (40001)
     *
     * @var string
     */
    public $nocaption;

    /**
     * Caption for yes radio button, needs to be set when typeid is `Mandatory` (40001)
     *
     * @var string
     */
    public $yescaption;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new opt in.
     *
     * **Note:** Ignored when updating an existing opt in.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new opt in.
     *
     * **Note:** Ignored when updating an existing opt in.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new opt in.
     *
     * **Note:** Ignored when updating an existing opt in.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack OptIn from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\OptIn
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new OptIn(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "availability" => isset($obj->availability) ? Json::unpackArray("OptInAvailability", $obj->availability) : null,
            "caption" => isset($obj->caption) ? $obj->caption : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "nocaption" => isset($obj->nocaption) ? $obj->nocaption : null,
            "yescaption" => isset($obj->yescaption) ? $obj->yescaption : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize OptIn to JSON.
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
        if (!is_null($this->caption)) {
            $result["caption"] = strval($this->caption);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->nocaption)) {
            $result["nocaption"] = strval($this->nocaption);
        }
        if (!is_null($this->yescaption)) {
            $result["yescaption"] = strval($this->yescaption);
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
