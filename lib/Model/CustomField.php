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
 * A single custom field.
 *
 * More info: see the get operation (api/settings/system/customfields/get) and the
 * custom fields endpoint (api/settings/system/customfields).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/CustomField).
 */
class CustomField implements \jsonSerializable
{
    /**
     * Create a new CustomField
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
     * **Note:** Ignored when creating a new custom field.
     *
     * **Note:** Ignored when updating an existing custom field.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing custom field.
     *
     * @var int
     */
    public $typeid;

    /**
     * Rules that define in what conditions this custom field is available when edit
     * type is `checkout`
     *
     * @var \Ticketmatic\Model\CustomfieldAvailability
     */
    public $availability;

    /**
     * Human-readable name for the custom field
     *
     * @var string
     */
    public $caption;

    /**
     * Human-readable description for the custom field. Will be visible for end-users
     * when edittype `checkout` is used
     *
     * @var string
     */
    public $description;

    /**
     * Type of editing that is allowed for the custom field. Links to systemtype
     * category 22xxx
     *
     * @var int
     */
    public $edittypeid;

    /**
     * Type of the custom field. Links to systemtype category 12xxx
     *
     * @var int
     */
    public $fieldtypeid;

    /**
     * The identifier for the custom field. Should contain only alphanumeric characters
     * and no whitespace, max length is 30 characters. The custom field will be
     * available in the api and the public data model as c_
     *
     * @var string
     */
    public $key;

    /**
     * Indicated whether the field is manually sortable
     *
     * @var bool
     */
    public $manualsort;

    /**
     * Indicates where the custom field is required. Links to systemtype category 30xxx
     *
     * @var int
     */
    public $requiredtypeid;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new custom field.
     *
     * **Note:** Ignored when updating an existing custom field.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new custom field.
     *
     * **Note:** Ignored when updating an existing custom field.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new custom field.
     *
     * **Note:** Ignored when updating an existing custom field.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack CustomField from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\CustomField
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new CustomField(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "availability" => isset($obj->availability) ? CustomfieldAvailability::fromJson($obj->availability) : null,
            "caption" => isset($obj->caption) ? $obj->caption : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "edittypeid" => isset($obj->edittypeid) ? $obj->edittypeid : null,
            "fieldtypeid" => isset($obj->fieldtypeid) ? $obj->fieldtypeid : null,
            "key" => isset($obj->key) ? $obj->key : null,
            "manualsort" => isset($obj->manualsort) ? $obj->manualsort : null,
            "requiredtypeid" => isset($obj->requiredtypeid) ? $obj->requiredtypeid : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize CustomField to JSON.
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
        if (!is_null($this->availability)) {
            $result["availability"] = $this->availability;
        }
        if (!is_null($this->caption)) {
            $result["caption"] = strval($this->caption);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->edittypeid)) {
            $result["edittypeid"] = intval($this->edittypeid);
        }
        if (!is_null($this->fieldtypeid)) {
            $result["fieldtypeid"] = intval($this->fieldtypeid);
        }
        if (!is_null($this->key)) {
            $result["key"] = strval($this->key);
        }
        if (!is_null($this->manualsort)) {
            $result["manualsort"] = (bool)$this->manualsort;
        }
        if (!is_null($this->requiredtypeid)) {
            $result["requiredtypeid"] = intval($this->requiredtypeid);
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
