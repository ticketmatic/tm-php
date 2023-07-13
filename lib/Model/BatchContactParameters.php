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
 * Parameters for batch operations performed on contacts
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/BatchContactParameters).
 */
class BatchContactParameters implements \jsonSerializable
{
    /**
     * Create a new BatchContactParameters
     *
     * @param array $data
     */
    public function __construct(array $data = array()) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Selection name, used for operation `sendselection`
     *
     * @var string
     */
    public $name;

    /**
     * [DEPRECATED] Use updatefields instead
     *
     * @var \Ticketmatic\Model\ContactBatchUpdate
     */
    public $fields;

    /**
     * Relation type IDs, used for operations `addrelationtypes` and
     * `removerelationtypes`
     *
     * @var int[]
     */
    public $ids;

    /**
     * Primary contact to merge into
     *
     * @var int
     */
    public $primary;

    /**
     * Set of fields to update, used for operation `update`. Custom fields are also
     * supported.
     *
     * @var \Ticketmatic\Model\BatchContactUpdateField[]
     */
    public $updatefields;

    /**
     * Unpack BatchContactParameters from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\BatchContactParameters
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new BatchContactParameters(array(
            "name" => isset($obj->name) ? $obj->name : null,
            "fields" => isset($obj->fields) ? ContactBatchUpdate::fromJson($obj->fields) : null,
            "ids" => isset($obj->ids) ? $obj->ids : null,
            "primary" => isset($obj->primary) ? $obj->primary : null,
            "updatefields" => isset($obj->updatefields) ? Json::unpackArray("BatchContactUpdateField", $obj->updatefields) : null,
        ));
    }

    /**
     * Serialize BatchContactParameters to JSON.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed {
        $result = array();
        if (!is_null($this->name)) {
            $result["name"] = strval($this->name);
        }
        if (!is_null($this->fields)) {
            $result["fields"] = $this->fields;
        }
        if (!is_null($this->ids)) {
            $result["ids"] = $this->ids;
        }
        if (!is_null($this->primary)) {
            $result["primary"] = intval($this->primary);
        }
        if (!is_null($this->updatefields)) {
            $result["updatefields"] = $this->updatefields;
        }

        return $result;
    }
}
