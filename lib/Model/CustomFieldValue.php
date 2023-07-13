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
 * A single custom field value.
 *
 * More info: see the get operation (api/settings/system/customfieldvalues/get) and
 * the custom field values endpoint (api/settings/system/customfieldvalues).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CustomFieldValue).
 */
class CustomFieldValue implements \jsonSerializable
{
    /**
     * Create a new CustomFieldValue
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
     * **Note:** Ignored when creating a new custom field value.
     *
     * **Note:** Ignored when updating an existing custom field value.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing custom field value.
     *
     * @var int
     */
    public $typeid;

    /**
     * Human-readable name for the value
     *
     * @var string
     */
    public $caption;

    /**
     * Indicated the manual sort order
     *
     * @var int
     */
    public $sortorder;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new custom field value.
     *
     * **Note:** Ignored when updating an existing custom field value.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new custom field value.
     *
     * **Note:** Ignored when updating an existing custom field value.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new custom field value.
     *
     * **Note:** Ignored when updating an existing custom field value.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack CustomFieldValue from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CustomFieldValue
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new CustomFieldValue(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "caption" => isset($obj->caption) ? $obj->caption : null,
            "sortorder" => isset($obj->sortorder) ? $obj->sortorder : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize CustomFieldValue to JSON.
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
        if (!is_null($this->caption)) {
            $result["caption"] = strval($this->caption);
        }
        if (!is_null($this->sortorder)) {
            $result["sortorder"] = intval($this->sortorder);
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
