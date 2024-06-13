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
 * A single filter definition.
 *
 * More info: see the get operation (api/settings/system/filterdefinitions/get) and
 * the filter definitions endpoint (api/settings/system/filterdefinitions).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/FilterDefinition).
 */
class FilterDefinition implements \jsonSerializable
{
    /**
     * Create a new FilterDefinition
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
     * **Note:** Ignored when creating a new filter definition.
     *
     * **Note:** Ignored when updating an existing filter definition.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing filter definition.
     *
     * @var int
     */
    public $typeid;

    /**
     * For certain filter types, the user must select a value from a list. The
     * checklistquery contains the sql clause to retrieve the list of available values.
     *
     * @var string
     */
    public $checklistquery;

    /**
     * Name for the filter
     *
     * @var string
     */
    public $description;

    /**
     * The type of filter definition defines the UI and resulting parameters that will
     * be used when a user selects the filter. The possible values can be found here
     * (api/settings/system/filterdefinitions).
     *
     * @var int
     */
    public $filtertype;

    /**
     * The sql clause that defines how the filter will work
     *
     * @var string
     */
    public $sqlclause;

    /**
     * Disable or enable filter
     *
     * @var bool
     */
    public $visible;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new filter definition.
     *
     * **Note:** Ignored when updating an existing filter definition.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new filter definition.
     *
     * **Note:** Ignored when updating an existing filter definition.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new filter definition.
     *
     * **Note:** Ignored when updating an existing filter definition.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack FilterDefinition from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\FilterDefinition
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new FilterDefinition(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "checklistquery" => isset($obj->checklistquery) ? $obj->checklistquery : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "filtertype" => isset($obj->filtertype) ? $obj->filtertype : null,
            "sqlclause" => isset($obj->sqlclause) ? $obj->sqlclause : null,
            "visible" => isset($obj->visible) ? $obj->visible : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize FilterDefinition to JSON.
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
        if (!is_null($this->checklistquery)) {
            $result["checklistquery"] = strval($this->checklistquery);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->filtertype)) {
            $result["filtertype"] = intval($this->filtertype);
        }
        if (!is_null($this->sqlclause)) {
            $result["sqlclause"] = strval($this->sqlclause);
        }
        if (!is_null($this->visible)) {
            $result["visible"] = (bool)$this->visible;
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
