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
 * A single field definition.
 *
 * More info: see the get operation (api/settings/system/fielddefinitions/get) and
 * the field definitions endpoint (api/settings/system/fielddefinitions).
 *
 * ## Help Center
 *
 * Full documentation can be found in the Ticketmatic Help Center
 * (https://apps.ticketmatic.com/#/knowledgebase/api/types/FieldDefinition).
 */
class FieldDefinition implements \jsonSerializable
{
    /**
     * Create a new FieldDefinition
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
     * **Note:** Ignored when creating a new field definition.
     *
     * **Note:** Ignored when updating an existing field definition.
     *
     * @var int
     */
    public $id;

    /**
     * Type ID
     *
     * **Note:** Ignored when updating an existing field definition.
     *
     * @var int
     */
    public $typeid;

    /**
     * Alignment of the field definition, when used in a view. Values can be 'left',
     * 'right' or 'center'
     *
     * @var string
     */
    public $align;

    /**
     * Human-readable name for the field definition
     *
     * @var string
     */
    public $description;

    /**
     * Key for the field definition. Should only consist of lowercase alphanumeric
     * characters
     *
     * @var string
     */
    public $key;

    /**
     * The actual definition of the field definition. Contains the sql clause that will
     * retrieve the information element in the database.
     *
     * @var string
     */
    public $sqlclause;

    /**
     * Will decide how the field will be rendered when used in a view.
     *
     * @var string
     */
    public $uitype;

    /**
     * Indicates whether the width for the field definition can be adapted when
     * stretching a view that includes the field definition across the whole available
     * width.
     *
     * @var bool
     */
    public $variablewidth;

    /**
     * Width of the field definition, when used in a view
     *
     * @var int
     */
    public $width;

    /**
     * Whether or not this item is archived
     *
     * **Note:** Ignored when creating a new field definition.
     *
     * **Note:** Ignored when updating an existing field definition.
     *
     * @var bool
     */
    public $isarchived;

    /**
     * Created timestamp
     *
     * **Note:** Ignored when creating a new field definition.
     *
     * **Note:** Ignored when updating an existing field definition.
     *
     * @var \DateTime
     */
    public $createdts;

    /**
     * Last updated timestamp
     *
     * **Note:** Ignored when creating a new field definition.
     *
     * **Note:** Ignored when updating an existing field definition.
     *
     * @var \DateTime
     */
    public $lastupdatets;

    /**
     * Unpack FieldDefinition from JSON.
     *
     * @param object $obj
     *
     * @return \Ticketmatic\Model\FieldDefinition
     */
    public static function fromJson($obj) {
        if ($obj === null) {
            return null;
        }

        return new FieldDefinition(array(
            "id" => isset($obj->id) ? $obj->id : null,
            "typeid" => isset($obj->typeid) ? $obj->typeid : null,
            "align" => isset($obj->align) ? $obj->align : null,
            "description" => isset($obj->description) ? $obj->description : null,
            "key" => isset($obj->key) ? $obj->key : null,
            "sqlclause" => isset($obj->sqlclause) ? $obj->sqlclause : null,
            "uitype" => isset($obj->uitype) ? $obj->uitype : null,
            "variablewidth" => isset($obj->variablewidth) ? $obj->variablewidth : null,
            "width" => isset($obj->width) ? $obj->width : null,
            "isarchived" => isset($obj->isarchived) ? $obj->isarchived : null,
            "createdts" => isset($obj->createdts) ? Json::unpackTimestamp($obj->createdts) : null,
            "lastupdatets" => isset($obj->lastupdatets) ? Json::unpackTimestamp($obj->lastupdatets) : null,
        ));
    }

    /**
     * Serialize FieldDefinition to JSON.
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
        if (!is_null($this->align)) {
            $result["align"] = strval($this->align);
        }
        if (!is_null($this->description)) {
            $result["description"] = strval($this->description);
        }
        if (!is_null($this->key)) {
            $result["key"] = strval($this->key);
        }
        if (!is_null($this->sqlclause)) {
            $result["sqlclause"] = strval($this->sqlclause);
        }
        if (!is_null($this->uitype)) {
            $result["uitype"] = strval($this->uitype);
        }
        if (!is_null($this->variablewidth)) {
            $result["variablewidth"] = (bool)$this->variablewidth;
        }
        if (!is_null($this->width)) {
            $result["width"] = intval($this->width);
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
