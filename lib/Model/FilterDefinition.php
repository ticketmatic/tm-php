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
 * A single filter definition.
 *
 * More info: see the get operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions/get)
 * and the filter definitions endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions).
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
     * Name for the filter
     *
     * @var string
     */
    public $description;

    /**
     * The sql clause that defines how the filter will work
     *
     * @var string
     */
    public $sqlclause;

    /**
     * The type of filter definition defines the UI and resulting parameters that will
     * be used when a user selects the filter. The possible values can be found here
     * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions).
     *
     * @var int
     */
    public $filtertype;

    /**
     * For certain filter types, the user must select a value from a list. The
     * checklistquery contains the sql clause to retrieve the list of available values.
     *
     * @var string
     */
    public $checklistquery;

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
            "description" => isset($obj->description) ? $obj->description : null,
            "sqlclause" => isset($obj->sqlclause) ? $obj->sqlclause : null,
            "filtertype" => isset($obj->filtertype) ? $obj->filtertype : null,
            "checklistquery" => isset($obj->checklistquery) ? $obj->checklistquery : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
        ));
    }

    /**
     * Serialize FilterDefinition to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        if (!is_null($this->id)) {
            $result["id"] = intval($this->id);
        }
        if (!is_null($this->typeid)) {
            $result["typeid"] = intval($this->typeid);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->sqlclause)) {
            $result["sqlclause"] = strval($this->sqlclause);
        }
        if (!is_null($this->filtertype)) {
            $result["filtertype"] = intval($this->filtertype);
        }
        if (!is_null($this->checklistquery)) {
            $result["checklistquery"] = strval($this->checklistquery);
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
