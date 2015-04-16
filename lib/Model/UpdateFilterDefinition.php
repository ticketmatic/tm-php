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
 * A set of fields to update a filter definition.
 *
 * More info: see filter definition
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/FilterDefinition), the
 * update operation
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions/update)
 * and the filter definitions endpoint
 * (https://apps.ticketmatic.com/#/knowledgebase/api/settings_system_filterdefinitions).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/UpdateFilterDefinition).
 */
class UpdateFilterDefinition implements \jsonSerializable
{
    /**
     * Create a new UpdateFilterDefinition
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $sqlclause;

    /**
     * @var int
     */
    public $filtertype;

    /**
     * @var string
     */
    public $checklistquery;

    /**
     * Unpack UpdateFilterDefinition from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\UpdateFilterDefinition
     */
    public static function fromJson($obj) {
        return new UpdateFilterDefinition(array(
            "description" => $obj->description,
            "sqlclause" => $obj->sqlclause,
            "filtertype" => $obj->filtertype,
            "checklistquery" => $obj->checklistquery,
        ));
    }

    /**
     * Serialize UpdateFilterDefinition to JSON.
     *
     * @return array
     */
    public function jsonSerialize() {
        $result = array();
        foreach ($fields as $field) {
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

        }
        return $result;
    }
}
