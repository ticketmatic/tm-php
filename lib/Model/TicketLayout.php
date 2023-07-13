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
 * A single ticket layout.
 *
 * More info: see the get operation
 * (api/settings/communicationanddesign/ticketlayouts/get) and the ticket layouts
 * endpoint (api/settings/communicationanddesign/ticketlayouts).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/TicketLayout).
 */
class TicketLayout implements \jsonSerializable
{
    /**
     * Create a new TicketLayout
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
     * **Note:** Ignored when creating a new ticket layout.
     *
     * **Note:** Ignored when updating an existing ticket layout.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing ticket layout.
     *
     * @var int
     */
    public $typeid;

    /**
     * Name for the ticket layout
     *
     * @var string
     */
    public $name;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new ticket layout.
     *
     * **Note:** Ignored when updating an existing ticket layout.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new ticket layout.
     *
     * **Note:** Ignored when updating an existing ticket layout.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new ticket layout.
     *
     * **Note:** Ignored when updating an existing ticket layout.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack TicketLayout from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\TicketLayout
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new TicketLayout(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "name" => isset($obj->name) ? $obj->name : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize TicketLayout to JSON.
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
