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
 * A single lock type.
 *
 * More info: see the get operation (api/settings/ticketsales/locktypes/get) and
 * the lock types endpoint (api/settings/ticketsales/locktypes).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/LockType).
 */
class LockType implements \jsonSerializable
{
    /**
     * Create a new LockType
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
     * **Note:** Ignored when creating a new lock type.
     *
     * **Note:** Ignored when updating an existing lock type.
     *
     * @var int
     */
    public $id;

    /**
     * Name for the lock type
     *
     * @var string
     */
    public $name;

    /**
     * The color of the lock type
     *
     * @var string
     */
    public $color;

    /**
     * Hides seats in online sales if this is true
     *
     * @var bool
     */
    public $hideseats;

    /**
     * Indicates whether this lock is a hard lock (meaning that it normally never will
     * be released and does not count for the inventory) or a soft lock
     *
     * @var bool
     */
    public $ishardlock;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new lock type.
     *
     * **Note:** Ignored when updating an existing lock type.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new lock type.
     *
     * **Note:** Ignored when updating an existing lock type.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new lock type.
     *
     * **Note:** Ignored when updating an existing lock type.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack LockType from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\LockType
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new LockType(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "color" => isset($obj->color) ? $obj->color : null,
            "hideseats" => isset($obj->hideseats) ? $obj->hideseats : null,
            "ishardlock" => isset($obj->ishardlock) ? $obj->ishardlock : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize LockType to JSON.
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
        if (!is_null($this->color)) {
            $result["color"] = strval($this->color);
        }
        if (!is_null($this->hideseats)) {
            $result["hideseats"] = (bool)$this->hideseats;
        }
        if (!is_null($this->ishardlock)) {
            $result["ishardlock"] = (bool)$this->ishardlock;
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
